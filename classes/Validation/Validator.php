<?php 

class Validator {

    public static function doValidate($request){
        $errors = [];

        foreach($request as $field){
            $rules = explode("|",$field['rules']);
            foreach($rules as $rule){
                // if($rule == 'required'){
                //     $required = new Required($field['name'],$field['value']);
                //     $strategy = new ValidationStrategy($required);
                //     $error = $strategy->validate();
                // }else if($rule == 'email'){

                // }
                $rule_class = ucfirst($rule);   // required -> Required, email->Email, ,min:3 ->Min:3
                if (strpos($rule_class, ':') !== false) {
                    // Min:3
                    $param_rules = explode(":",$rule_class);
                    /*
                        array(
                            'Min', 3
                        )
                    */
                    $rule_obj = new $param_rules[0]($field['name'],$field['value'],$param_rules[1]);
                }else{
                    $rule_obj = new $rule_class($field['name'],$field['value']);
                }
                
                $strategy = new ValidationStrategy($rule_obj);
                $error = $strategy->validate();
                if(!empty($error)){
                    $errors[$field['name']][] = $error;
                }
                
               
            }
        }

        return $errors;
    }
}