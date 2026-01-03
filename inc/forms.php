<?php 
/**
 * Contact Form 7
 */

 function charity_become_volunteer_cf7_form() {
    if (class_exists('WPCF7_ContactForm')) {
        $form_title = 'charity_become_volunteer_form';

        // Check if the form already exists
        $forms = get_posts([
            'post_type'      => 'wpcf7_contact_form',
            'title'          => $form_title,
            'posts_per_page' => 1,
            'post_status'    => 'publish',
        ]);

        $existing_form = !empty($forms) ? $forms[0] : null;

        if (!$existing_form) {
            // Define the form content
            $form_fields = '<div class="row">
                                <div class="col-lg-6 col-12">
                                    [text* volunteer-name autocomplete:name class:form-control placeholder "Jack Doe"]
                                </div>

                                <div class="col-lg-6 col-12">    
                                    [email* volunteer-email autocomplete:email class:form-control placeholder "Jackdoe@gmail.com"]
                                </div>

                                <div class="col-lg-6 col-12">
                                    [text* volunteer-subject autocomplete:name class:form-control placeholder "Subject"]
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="input-group input-group-file">
                                        [file volunteer-cv class:form-control filetypes:pdf limit:1mb id:inputGroupFile02]
                                        
                                        <label class="input-group-text" for="inputGroupFile02">Upload your CV</label>

                                        <i class="bi-cloud-arrow-up ms-auto"></i>
                                    </div>
                                </div>
                            </div>

                            [textarea volunteer-message class:form-control rows:3 placeholder] Comment (Optional) [/textarea]
                            [submit class:form-control "Submit"]';

            // Create a new form template
            $cf7 = WPCF7_ContactForm::get_template();
            $cf7->set_title($form_title);
            $cf7->set_properties([
                'form' => $form_fields
            ]);
            $cf7->save();
        }
    }
}
add_action('after_switch_theme', 'charity_become_volunteer_cf7_form');


 function charity_contact_cf7_form() {
    if (class_exists('WPCF7_ContactForm')) {
        $form_title = 'charity_contact_form';

        // Check if the form already exists
        $forms = get_posts([
            'post_type'      => 'wpcf7_contact_form',
            'title'          => $form_title,
            'posts_per_page' => 1,
            'post_status'    => 'publish',
        ]);

        $existing_form = !empty($forms) ? $forms[0] : null;

        if (!$existing_form) {
            // Define the form content
            $form_fields = '<div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    [text* first-name autocomplete:name class:form-control placeholder "Jack"]
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    [text* last-name autocomplete:name class:form-control placeholder "Doe"]
                                </div>
                            </div>

                            [email* email autocomplete:email class:form-control placeholder "Jackdoe@gmail.com"]

                            [textarea* message class:form-control rows:3 placeholder] What can we help you? [/textarea*]

                            [submit class:form-control "Send Message"]';

            // Create a new form template
            $cf7 = WPCF7_ContactForm::get_template();
            $cf7->set_title($form_title);
            $cf7->set_properties([
                'form' => $form_fields
            ]);
            $cf7->save();
        }
    }
}
add_action('after_switch_theme', 'charity_contact_cf7_form');