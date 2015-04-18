<?php
App::uses('FormHelper', 'View/Helper');
App::uses('Set', 'Utility');

class CakeStrapFormHelper extends FormHelper
{
    public function listErrors()
    {
        $isErrors = false;
        foreach ($this->validationErrors as $model) {
            if (!empty($model)) {
                $isErrors = true;
                break;
            }
        }

        if ($isErrors) {
            echo '<div class="alert alert-danger"><ul class="row">';
            foreach ($this->validationErrors as $modelName => $list) {
                foreach ($list as $k => $v) {
                    if (is_array($v)) {
                        foreach ($v as $kword => $val) {
                            if (is_array($val))
                                continue;
                            echo '<li>' . $val . '</li>';
                        }
                    } else
                        echo '<li>' . $v . '</li>';
                }
            }
            echo '</ul></div>';
        }
    }

    public function create($model = null, $options = array())
    {
        if (!array_key_exists('class', $options))
            $options['class'] = 'row';

        return parent::create($model, $options);
    }

    public function input($fieldName = array(), $options = array())
    {
        $default = array(
            'errorClass' => 'has-error error',
            'divClass' => 'form-group',
            'label' => array(
                'text' => false,
                'class' => 'control-label'
            ),
        );

        if (array_key_exists('label', $options) && $options['label'] !== false && !is_array($options['label'])) {
            $options['label'] = array(
                'text' => $options['label']
            );

            /*
            if (!$options['label']['text']) {
                if (array_key_exists('placeholder', $options))
                    $default['label']['text'] = $options['placeholder'];
                $default['label']['class'] = 'sr-only';
            }
            */
        }

        if (!isset($options['type']) || !in_array($options['type'], array('checkbox')))
            $default['class'] = 'form-control';

        $options = Hash::merge(
            $default,
            $options
        );

        return parent::input($fieldName, $options);
    }

    public function button($caption = null, $options = array())
    {
        $default = array(
            'class' => 'btn btn-primary',
            'div' => false
        );

        $options = Hash::merge(
            $default,
            $options
        );
        return parent::button($caption, $options);
    }

    public function submit($caption = null, $options = array())
    {
        return $this->button($caption, $options);
    }

    /**
     * Generate div options for input
     *
     * @param array $options
     * @return array
     */
    protected function _divOptions($options)
    {
        $divOptions = parent::_divOptions($options);

        $divOptions = $this->addClass($divOptions, $options['divClass']);

        if ($this->tagIsInvalid() !== false) {
            $divOptions = $this->addClass($divOptions, $options['errorClass']);
        }

        return $divOptions;
    }
}
