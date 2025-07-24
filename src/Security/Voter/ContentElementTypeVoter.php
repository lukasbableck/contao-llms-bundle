<?php
namespace Lukasbableck\ContaoLlmsBundle\Security\Voter;

use Contao\CoreBundle\Security\DataContainer\CreateAction;
use Contao\CoreBundle\Security\DataContainer\DeleteAction;
use Contao\CoreBundle\Security\DataContainer\ReadAction;
use Contao\CoreBundle\Security\DataContainer\UpdateAction;
use Contao\CoreBundle\Security\Voter\DataContainer\AbstractDataContainerVoter;
use Contao\PageModel;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ContentElementTypeVoter extends AbstractDataContainerVoter {
	protected function getTable(): string {
		return 'tl_content';
	}

	protected function hasAccess(TokenInterface $token, CreateAction|DeleteAction|ReadAction|UpdateAction $action): bool {
		if ($action instanceof CreateAction) {
			if (!$action->getNew()) {
				return true;
			}
			if (!isset($action->getNew()['type'])) {
				return true;
			}

			if ($action->getNew()['ptable'] != 'tl_page') {
				if (str_starts_with($action->getNew()['type'], 'llms_')) {
					return false;
				}

				return true;
			}

			$parent = PageModel::findByPk($action->getNew()['pid']);
			if ($parent === null) {
				return false;
			}

			$type = $action->getNew()['type'];
			if (str_starts_with($type, 'llms_') && $parent->type !== 'llms') {
				return false;
			}
			if (str_starts_with($type, 'llms_') && $parent->type === 'llms') {
				return true;
			}
			if (!str_starts_with($type, 'llms_') && $parent->type === 'llms') {
				return false;
			}
		}

		return true;
	}
}
