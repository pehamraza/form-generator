<?php

require_once 'Field_types.php';

class Form
{
    protected $json_source = '';
    protected $form_type = 'get';
    protected $use_bootstrap = true;
    protected $all_fields_required = true;
    protected $form_elements = NULL;

    /**
     * Form constructor.
     * @param $form_type string ['get', 'post']
     * @param $json_source string
     */
    public function __construct($form_type, $json_source){
        $this->form_type = $form_type;
        $this->json_source = $json_source;

        //read file
        $json = @file_get_contents($this->json_source);
        $this->form_elements = json_decode($json);
    }

    public function generate(){

        if(!empty($this->form_elements)){

            if($this->use_bootstrap){
                $this->add_bootstrap();
            }

            // form start tag
            $this->start_form();

            // read elements and generate html
            if(isset($this->form_elements)) {
                foreach ($this->form_elements as $element) {
                    echo $this->generate_element_html($element);
                }
            }
            else echo 'No form elements';

            // form end tag
            $this->end_form();
            $this->add_validation_js();

        }
        else{
            echo '<!-- No Form Elements Found to be created -->';
        }
    }

    private function generate_element_html($element)
    {

        $label = '
                <label for="'.$element->field_id.'" class="label col-form-label col-sm-3">'.$element->field_name.'</label>
                ';
        $default_input_element = '<input 
                                    name="'.$element->field_id.'" 
                                    id="'.$element->field_id.'" 
                                    type="'.$element->field_type.'" 
                                    value="'.$element->default_value.'" 
                                    placeholder="'.$element->field_name.'" 
                                    '.($this->all_fields_required ? 'required="required"': '').' />';

        $created_element = '
        <div class="form-group">';

        switch ($element->field_type){
            case Field_types::TEXT:
            case Field_types::EMAIL:
            case Field_types::PASSWORD:
                $use_default_input = true;
                break;

            case Field_types::TEXTAREA:
                $use_default_input = false;
                $created_element .= $label.'<br>';
                $created_element .= '<textarea id="'.$element->field_id.'" 
                                                placeholder="'.$element->field_name.'"
                                                class="form-control"
                                                '.($this->all_fields_required ? 'required="required"': '').'>'.
                                                $element->default_value.'</textarea>';
                break;

            case Field_types::SELECT:
                $created_element .= '<select value="'.$element->default_value.'" id="'.$element->field_id.'" '.
                                    ($this->all_fields_required ? 'required="required"': '').'>';
                $created_element.='</select>';
                break;

            case Field_types::RADIO:
                $use_default_input = false;
                $created_element .= $label;
                if(isset($element->options)){
                    foreach ($element->options as $option){
                        $created_element .= ' <input type="'.$element->field_type.'" value="'.$option.'" name="'.$element->field_id.'" '.
                                            ($this->all_fields_required ? 'required="required"': '')
                                            .($element->default_value == $option ? ' checked="checked"': '').'/>';
                        $created_element .= ' <label for="'.$option.'"  name="'.$element->field_id.'">'.ucfirst($option).'</label>';
                    }
                }
                break;

            case Field_types::CHECKBOX:
                $use_default_input = false;
                $created_element .= $label;
                if(isset($element->options)){
                    foreach ($element->options as $option){
                        $created_element .= '
                                             <input type="'.$element->field_type.'" value="'.$option.'" name="'.$element->field_id.'[]" class="checkbox" '.
                                            ($this->all_fields_required ? 'required': '').
                                            ($element->default_value == $option ? ' checked="checked"': '').'/>';
                        $created_element .= ' <label for="'.$option.'"  name="'.$element->field_id.'">'.ucfirst($option).'</label>';
                    }
                }
                break;

        }

        if($use_default_input){
            $created_element.= $label.$default_input_element;
        }

        $created_element.='
                        </div>';
        return $created_element;
    }

    private function start_form()
    {
        echo '<h3>Test for Sam</h3>';
        echo '<form class="form col-md-6" method="'.$this->form_type.'">';
    }

    private function end_form()
    {
        echo '
            <button id="submit" class="btn btn-primary" type="submit">Submit</button>';
        echo '
            </form>
            ';
    }

    private function add_validation_js(){
        echo '
        <script type="text/javascript">
       
        let submitButton = document.querySelector("#submit")
        let checkboxes = document.querySelectorAll("input[type=checkbox]");
        
        submitButton.addEventListener("click", e => {
            
            // validation for making sure 1 checkbox is checked
            
            var checked = false;
            for (i=0; i<checkboxes.length; i++){
                console.log(checkboxes[i].value, checkboxes[i].checked);
                if(checkboxes[i].checked === true)
                    checked = true;
            }
            if(checked){ // 1 checked reset all others
                for (i=0; i<checkboxes.length; i++){
                   checkboxes[i].required = false
                }
            }else{
                for (i=0; i<checkboxes.length; i++){
                   checkboxes[i].required = true;
                }
            }
        });
        
        </script>';

    }

    public function submit_form(){

    }

    protected function add_bootstrap()
    {
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
              <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
              <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="undefined" crossorigin="anonymous"></script>';
    }
}
