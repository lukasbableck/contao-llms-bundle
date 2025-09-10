<?php
namespace Lukasbableck\ContaoLlmsBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;

#[AsCallback('tl_page', 'config.onload')]
class PageChildrenLoadListener {
    public function __invoke(?DataContainer $dc = null): void {
        if ($dc === null) {
            return;
        }
        $GLOBALS['TL_DCA']['tl_page']['list']['operations'] = \array_slice($GLOBALS['TL_DCA']['tl_page']['list']['operations'], 0, 1, true) + ['children' => []] + \array_slice($GLOBALS['TL_DCA']['tl_page']['list']['operations'], 1, \count($GLOBALS['TL_DCA']['tl_page']['list']['operations']) - 1, true);
        $GLOBALS['TL_DCA']['tl_page']['list']['operations']['children'] = [
            'label' => &$GLOBALS['TL_LANG']['DCA']['children'],
            'href' => 'table=tl_content&amp;ptable=tl_page',
            'icon' => 'children.svg',
            'button_callback' => [PageChildrenOperationListener::class, '__invoke'],
            'primary' => true,
        ];
    }
}
