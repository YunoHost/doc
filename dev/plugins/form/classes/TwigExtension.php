<?php declare(strict_types=1);

namespace Grav\Plugin\Form;

use Grav\Framework\Form\Interfaces\FormInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use function is_string;

/**
 * Class GravExtension
 * @package Grav\Common\Twig\Extension
 */
class TwigExtension extends AbstractExtension
{
    public function getFilters()
    {
       return [
            new TwigFilter('value_and_label', [$this, 'valueAndLabel'])
       ];
    }

    /**
     * Return a list of all functions.
     *
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('prepare_form_fields', [$this, 'prepareFormFields'], ['needs_context' => true]),
            new TwigFunction('prepare_form_field', [$this, 'prepareFormField'], ['needs_context' => true]),
            new TwigFunction('include_form_field', [$this, 'includeFormField']),
        ];
    }

    public function valueAndLabel($value): array
    {
        if (!is_array($value)) {
            return [];
        }

        $list = [];
        foreach ($value as $key => $label) {
            $list[] = ['value' => $key, 'label' => $label];
        }

        return $list;
    }

    /**
     * Filters form fields for the current parent.
     *
     * @param array $context
     * @param array $fields Form fields
     * @param string|null $parent Parent field name if available
     * @return array
     */
    public function prepareFormFields(array $context, $fields, $parent = null): array
    {
        $list = [];

        if (is_iterable($fields)) {
            foreach ($fields as $name => $field) {
                $field = $this->prepareFormField($context, $field, $name, $parent);
                if ($field) {
                    $list[$field['name']] = $field;
                }
            }
        }

        return $list;
    }

    /**
     * Filters field name by changing dot notation into array notation.
     *
     * @param array $context
     * @param array $field Form field
     * @param string|int|null $name Field name (defaults to field.name)
     * @param string|null $parent Parent field name if available
     * @param array|null $options List of options to override
     * @return array|null
     */
    public function prepareFormField(array $context, $field, $name = null, $parent = null, array $options = []): ?array
    {
        // Make sure that the field is a valid form field type and is not being ignored.
        if (empty($field['type']) || ($field['validate']['ignore'] ?? false)) {
            return null;
        }

        // Check if we have just a list of fields (no name given).
        if (is_int($name)) {
            // Look at the field.name and if not set, fall back to the key.
            $name = (string)($field['name'] ?? $name);
        }

        // Make sure that the field has a name.
        $name = $name ?? $field['name'] ?? null;
        if (!is_string($name) || $name === '') {
            return null;
        }

        // Prefix name with the parent name if needed.
        if (str_starts_with($name, '.')) {
            $name = $parent ? $parent . $name : (string)substr($name, 1);
        } elseif (isset($options['key'])) {
            $name = str_replace('*', $options['key'], $name);
        }

        unset($options['key']);

        // Set fields as readonly if form is in readonly mode.
        /** @var FormInterface $form */
        $form = $context['form'] ?? null;
        if ($form && method_exists($form, 'isEnabled') && !$form->isEnabled()) {
            $options['disabled'] = true;
        }

        // Loop through options
        foreach ($options as $key => $option) {
            $field[$key] = $option;
        }

        // Always set field name.
        $field['name'] = $name;

        return $field;
    }

    /**
     * @param string $type
     * @param string|string[]|null $layouts
     * @param string|null $default
     * @return string[]
     */
    public function includeFormField(string $type, $layouts = null, string $default = null): array
    {
        $list = [];
        foreach ((array)$layouts as $layout) {
            $list[] = "forms/fields/{$type}/{$layout}-{$type}.html.twig";
        }
        $list[] = "forms/fields/{$type}/{$type}.html.twig";

        if ($default) {
            foreach ((array)$layouts as $layout) {
                $list[] = "forms/fields/{$default}/{$layout}-{$default}.html.twig";
            }
            $list[] = "forms/fields/{$default}/{$default}.html.twig";
        }

        return $list;
    }
}
