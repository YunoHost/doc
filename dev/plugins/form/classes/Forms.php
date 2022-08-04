<?php

namespace Grav\Plugin\Form;

use Grav\Common\Page\Interfaces\PageInterface;
use Grav\Common\Page\Page;
use Grav\Framework\Form\Interfaces\FormFactoryInterface;
use Grav\Framework\Form\Interfaces\FormInterface;

class Forms
{
    /** @var array|FormFactoryInterface[] */
    private $types;
    /** @var FormInterface|null */
    private $form;

    /**
     * Forms constructor.
     */
    public function __construct()
    {
        $this->registerType('form', new FormFactory());
    }

    /**
     * @param string $type
     * @param FormFactoryInterface $factory
     */
    public function registerType(string $type, FormFactoryInterface $factory): void
    {
        $this->types[$type] = $factory;
    }

    /**
     * @param string $type
     */
    public function unregisterType($type): void
    {
        unset($this->types[$type]);
    }

    /**
     * @param string $type
     * @return bool
     */
    public function hasType(string $type): bool
    {
        return isset($this->types[$type]);
    }

    /**
     * @return array
     */
    public function getTypes(): array
    {
        return array_keys($this->types);
    }

    /**
     * @param PageInterface $page
     * @param string|null $name
     * @param array|null $form
     * @return FormInterface|null
     */
    public function createPageForm(PageInterface $page, string $name = null, array $form = null): ?FormInterface
    {
        if (null === $form) {
            [$name, $form] = $this->getPageParameters($page, $name);
        }

        if (null === $form) {
            return null;
        }

        $type = $form['type'] ?? 'form';
        $factory = $this->types[$type] ?? null;

        if ($factory) {
            if (is_callable([$factory, 'createFormForPage'])) {
                return $factory->createFormForPage($page, $name, $form);
            }

            if ($page instanceof Page) {
                // @phpstan-ignore-next-line
                return $factory->createPageForm($page, $name, $form);
            }
        }

        return null;
    }

    /**
     * @return FormInterface|null
     */
    public function getActiveForm(): ?FormInterface
    {
        return $this->form;
    }

    /**
     * @param FormInterface $form
     * @return void
     */
    public function setActiveForm(FormInterface $form): void
    {
        $this->form = $form;
    }

    /**
     * @param PageInterface $page
     * @param string|null $name
     * @return array
     */
    protected function getPageParameters(PageInterface $page, ?string $name): array
    {
        $forms = $page->getForms();

        if ($name) {
            // If form with given name was found, use that.
            $form = $forms[$name] ?? null;
        } else {
            // Otherwise pick up the first form.
            $form = reset($forms) ?: null;
            $name = (string)key($forms);
        }

        return [$name, $form];
    }
}
