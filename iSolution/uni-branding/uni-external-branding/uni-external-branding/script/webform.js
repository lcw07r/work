/*global jQuery, document*/
"use strict";
jQuery(document).ready(function () {

    // Add regex validator.
    jQuery.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            if (regexp.constructor != RegExp) {
                regexp = new RegExp(regexp);
            }
            else if (regexp.global) {
                regexp.lastIndex = 0;
            }
            return this.optional(element) || regexp.test(value);
        },
        "Please check your input."
    );

    // Validate form.
    jQuery("#webform").validate();

    // Validation fields.
    
    // TODO: Remove element check. From some reason if the element does not
    // exist, it causes jQuery to crash. Possible validation plugin bug?
    
    if (jQuery(".validation_email").length !== 0) {
        jQuery(".validation_email").rules("add", {
            regex: /^[a-zA-Z][\w\.\-\']*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.\-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/,
            messages: { regex: "Please supply a valid email address." }
        });
    }
    
    if (jQuery(".validation_soton_email").length !== 0) {
        jQuery(".validation_soton_email").rules("add", {
            regex: /^[a-zA-Z][\w\.\-\']*[a-zA-Z0-9]@([\w]+\.)?soton\.ac\.uk$/,
            messages: { regex: "Please supply a valid University of Southampton email address." }
        });
    }
    
    if (jQuery(".validation_phone").length !== 0) {
        jQuery(".validation_phone").rules("add", {
            regex: /^[\(\) -+\d]{7,24}$/,
            messages: { regex: "Please supply a valid phone number." }
        });
    }

    if (jQuery(".validation_uk_phone").length !== 0) {
        jQuery(".validation_uk_phone").rules("add", {
            regex: /^\(?\d\d\d\)? ?\d\d\)? ?\d\d\d ?\d\d\d$/,
            messages: { regex: "Please supply a valid UK phone number." }
        });
    }

    if (jQuery(".validation_staff_no").length !== 0) {
        jQuery(".validation_staff_no").rules("add", {
            regex: /^(1-)?1\d{6}$/,
            messages: { regex: "Please supply a valid University of Southampton staff number." }
        });
    }

    if (jQuery(".validation_iss").length !== 0) {
        jQuery(".validation_iss").rules("add", {
            regex: /^[a-z][a-z0-9]{1,7}$/,
            messages: { regex: "Please supply a valid ISS username." }
        });
    }

    if (jQuery(".validation_name").length !== 0) {
        jQuery(".validation_name").rules("add", {
            regex: /^[a-zA-Z|\'| ]{5,}$/,
            messages: { regex: "Please supply your full name." }
        });
    }

    if (jQuery(".validation_comment").length !== 0) {
        jQuery(".validation_comment").rules("add", {
            minlength: 3,
            messages: { minlength: "Please supply more than {0} characters." }
        });
    }

    if (jQuery(".validation_number").length !== 0) {
        jQuery(".validation_number").rules("add", {
            regex: /^[0-9]+$/,
            messages: { regex: "Please supply a number comprised of digits only." }
        });
    }

    if (jQuery(".validation_strict_number").length !== 0) {
        jQuery(".validation_strict_number").rules("add", {
            regex: /^[0-9]*\.?[0-9]+$/,
            messages: { regex: "Please supply a number that uses only digits and\nzero or one decimal points." }
        });
    }

    if (jQuery(".validation_course").length !== 0) {
        jQuery(".validation_course").rules("add", {
            regex: /^[A-Za-z]{1,2}[0-9]{2,3}$/,
            messages: { regex: "Please supply a valid course code." }
        });
    }

    if (jQuery(".validation_course_list").length !== 0) {
        jQuery(".validation_course_list").rules("add", {
            regex: /^[A-Za-z]{1,2}[0-9]{2,3}((( |, |,)([A-Za-z]{1,2}[0-9]{2,3})+)+)?$/,
            messages: { regex: "Please list course codes, separated by spaces or commas." }
        });
    }

    if (jQuery(".validation_date").length !== 0) {
        jQuery(".validation_date").rules("add", {
            regex: /^(?:(?:0?[1-9]|1\d|2[0-8])(\/|-)(?:0?[1-9]|1[0-2]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:31(\/|-)(?:0?[13578]|1[02]))|(?:(?:29|30)(\/|-)(?:0?[1,3-9]|1[0-2])))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(29(\/|-)0?2)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$/,
            messages: { regex: "Please supply a valid date in the format\n'dd/mm/yyyy' or 'dd-mm-yyyy'." }
        });
    }

    if (jQuery(".validation_year").length !== 0) {
        jQuery(".validation_year").rules("add", {
            regex: /^(19|20)\d\d$/,
            messages: { regex: "Please supply a valid four-digit year." }
        });
    }

    if (jQuery(".validation_post").length !== 0) {
        jQuery(".validation_post").rules("add", {
            regex: /^[A-Za-z]{1,2}[\d]{1,2}([A-Za-z])?\s?[\d][A-Za-z]{2}$/,
            messages: { regex: "Please supply a valid UK Post Code." }
        });
    }

    if (jQuery(".validation_student_no").length !== 0) {
        jQuery(".validation_student_no").rules("add", {
            regex: /^2\d{7}$/,
            messages: { regex: "Please supply a valid Student Application Number (starting\nwith \'2\', followed by seven digits)." }
        });
    }

    if (jQuery(".validation_acc_no").length !== 0) {
        jQuery(".validation_acc_no").rules("add", {
            regex: /^WEB-\d{6}$/,
            messages: { regex: "Please supply a valid Accommodation Application Number\n(starting with \'WEB-\', followed by six digits)." }
        });
    }
});