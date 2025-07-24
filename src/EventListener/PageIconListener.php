<?php
namespace Lukasbableck\ContaoLlmsBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Lukasbableck\ContaoLlmsBundle\Controller\Page\LlmsPageController;

#[AsHook('getPageStatusIcon')]
class PageIconListener {
	public function __invoke(object $page, string $image): string {
		if ($page->type !== LlmsPageController::TYPE) {
			return $image;
		}

		return '/bundles/contaollms/bot.svg';
	}
}
