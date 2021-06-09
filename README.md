# Form Generator
Basic form generator core PHP class with json as source.

You can use the json provided with the class in file "source.json" to create a basic form.

I have added a test with default values in json file named "test.json". Use this file to populate a form with test input values.

Run contact.html file to populate the form.

Use the class "Form.php" as 

```
    $form = new Form($method, $url, $source);
    $form->generate();
```

Turn off bootstrap styling by setting the "$use_bootstrap" class property to false  

Switch between get or post method for form by changing the form_type value to post.
