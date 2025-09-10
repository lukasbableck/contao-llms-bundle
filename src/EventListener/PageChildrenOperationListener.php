<?php
namespace Lukasbableck\ContaoLlmsBundle\EventListener;

use Contao\CoreBundle\DataContainer\DataContainerOperation;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;

#[AsCallback('tl_page', 'list.operations.children.button')]
class PageChildrenOperationListener {
    public function __invoke(DataContainerOperation $operation): void {
        if ($operation->getRecord()['type'] !== 'llms') {
            $operation->setHtml('');

            return;
        }
    }
}
