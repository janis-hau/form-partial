<?php

require_once 'inc/helper/helper.php';

$form_settings = file_get_contents( 'inc/config.json' );
$form_settings = json_decode( $form_settings, true );

$form_config = array();
$form_config = array_merge( $form_config, $form_settings );

function buildForm( $arrays ) {
    // prer( $arrays );

    $form_template;
    if ( $arrays['form'] ) :
        // FORM
        $form_template = '<form ';
        foreach ($arrays['form'] as $key => $value) :
            $form_template .= ' ' . $key . '="' . $value . '"';
        endforeach;
        $form_template .= '>';
        // FIELDS

        foreach ($arrays['fields'] as $key => $field) :

            if ( array_key_exists( 'container', $field ) ) {
                if ( array_key_exists( 'element', $field['container'] ) )
                    $form_template .= '<' . $field['container']['element'];
                else
                    $form_template .= '<div';
                
                if ( array_key_exists( 'class', $field['container'] ) )
                    $form_template .= ' class="' . $field['container']['class'] . '"';
                
                if ( array_key_exists( 'id', $field['container'] ) )
                    $form_template .= ' id="' . $field['container']['id'];
                
                $form_template .=  '">';
            } else {
                $form_template .= '<div';
                $form_template .= ' class="form__field  form__field--' . strtolower( $key );
                $form_template .=  '">';
            }

            if ( $field['type'] !== 'select'   && 
                 $field['type'] !== 'textarea' &&
                 $field['type'] !== 'submit'
            ) :

                if ( array_key_exists( 'label', $field ) ) :
                    $form_template .= '<label for="' . strtolower( $key ) . '"';
    
                    $label_class="";
                    if ( array_key_exists( 'class', $field['label'] ) )
                        $label_class .= $field['label']['class'];
    
                    if ( array_key_exists( 'required', $field['label'] ) )
                        $label_class .= ' ' . $field['label']['class'];
    
                    if ( !empty($label_class) )
                        $form_template .= ' class="'.$label_class.'"';
    
                    $form_template .= '>'; 
                    $form_template .= $field['label']['text'] . '</label>&nbsp;';
                endif;

                // Input
                $form_template .= '<input id="' . strtolower( $key ) . '"';
                foreach ($field as $attribute => $value) :
                    if ( $attribute !== 'label'      && 
                         $attribute !== 'required'   &&
                         $attribute !== 'disabled'   &&
                         $attribute !== 'novalidate' &&
                         $attribute !== 'container'
                    ) {
                        $form_template .= ' ' . $attribute . '="' . $value . '"';
                    } elseif ( $attribute === 'required'   && $value ||
                               $attribute === 'disabled'   && $value ||
                               $attribute === 'novalidate' && $value
                    ) {
                        $form_template .= ' ' . $attribute; 
                    }
                endforeach;
                $form_template .= '/>';
            elseif ( $field['type'] === 'select'   ) :
                $form_template .= 'select';

            elseif ( $field['type'] === 'textarea' ) :
                $form_template .= 'textarea';
            
            elseif ( $field['type'] === 'submit'   ) :
                $form_template .= '<button';

                foreach ($field as $attribute => $value) {
                    if ( $attribute !== 'text'
                    ) {
                        $form_template .= ' ' . $attribute . '="' . $value . '"';
                    }
                }
                $form_template .= '>';
                $form_template .= $field['text'];
                $form_template .= '</button>';

            endif;

            if ( array_key_exists( 'container', $field ) ) {
                $form_template .= '</'  . $field['container']['element'] . '>'; // End of form__field
            } else {
                $form_template .= '</div>';
            }
        endforeach;

        // FIELDS

        // /FORM
        $form_template .='</form>';
    endif;
    return $form_template;

}