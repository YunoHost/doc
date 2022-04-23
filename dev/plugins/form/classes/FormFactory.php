<?php declare(strict_types=1);

namespace Grav\Plugin\Form;

use Grav\Common\Page\Interfaces\PageInterface;
use Grav\Common\Page\Page;
use Grav\Framework\Form\Interfaces\FormFactoryInterface;
use Grav\Framework\Form\Interfaces\FormInterface;

class FormFactory implements FormFactoryInterface
{
    /**
     * Create form using the header of the page.
     *
     * @param Page $page
     * @param string $name
     * @param array $form
     * @return Form|null
     * @deprecated 1.6 Use FormFactory::createFormByPage() instead.
     */
    public function createPageForm(Page $page, string $name, array $form): ?FormInterface
    {
        return new Form($page, $name, $form);
    }

    /**
     * Create form using the header of the page.
     *
     * @param PageInterface $page
     * @param string $name
     * @param array $form
     * @return Form|null
     */
    public function createFormForPage(PageInterface $page, string $name, array $form): ?FormInterface
    {
        return new Form($page, $name, $form);
    }
}
