<?php
namespace Lukasbableck\ContaoLlmsBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Filesystem\FilesystemItem;
use Contao\CoreBundle\Filesystem\FilesystemUtil;
use Contao\CoreBundle\Filesystem\VirtualFilesystem;
use Contao\CoreBundle\Image\Studio\Figure;
use Contao\CoreBundle\Image\Studio\Studio;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(self::TYPE, category: 'llms')]
class LlmsImageController extends AbstractContentElementController {
	public const TYPE = 'llms_image';

	public function __construct(
		#[Autowire('@contao.filesystem.virtual.files')]
		private readonly VirtualFilesystem $filesStorage,
		#[Autowire('%contao.image.valid_extensions%')]
		private readonly array $validExtensions,
		private readonly Studio $studio,
	) {
	}

	public function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response {
		$filesystemItems = FilesystemUtil::listContentsFromSerialized($this->filesStorage, $model->singleSRC)
			->filter(fn ($item) => \in_array($item->getExtension(true), $this->validExtensions, true))
		;

		$figureBuilder = $this->studio->createFigureBuilder();
		$figureBuilder->setOverwriteMetadata($model->getOverwriteMetadata());

		$imageList = array_filter(array_map(
			fn (FilesystemItem $filesystemItem): ?Figure => $figureBuilder
				->fromStorage($this->filesStorage, $filesystemItem->getPath())
				->buildIfResourceExists(),
			iterator_to_array($filesystemItems),
		));

		if (!$imageList) {
			return new Response();
		}

		$template->host = $request->getSchemeAndHttpHost();
		$template->image = $imageList[0];

		return $template->getResponse();
	}
}
