<?php
namespace Lukasbableck\ContaoLlmsBundle\Controller\Page;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\AbstractController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsPage;
use Contao\FrontendTemplate;
use Contao\PageModel;
use Symfony\Component\HttpFoundation\Response;

#[AsPage(self::TYPE, urlSuffix: '.txt', contentComposition: false)]
class LlmsPageController extends AbstractController {
    public const TYPE = 'llms';

    public function __invoke(PageModel $pageModel): Response {
        $template = new FrontendTemplate('page/llms_txt');
        $template->title = $pageModel->llmsTitle;
        $template->description = $pageModel->llmsDescription;

        $elements = [];
        $contentElements = ContentModel::findPublishedByPidAndTable($pageModel->id, 'tl_page');
        if ($contentElements !== null) {
            foreach ($contentElements as $element) {
                $elements[] = $element;
            }
        }
        $template->elements = $elements;
        $response = new Response($template->getResponse()->getContent());
        $response->headers->set('Content-Type', 'text/plain; charset=utf-8');

        $this->setCacheHeaders($response, $pageModel);

        return $response;
    }
}
