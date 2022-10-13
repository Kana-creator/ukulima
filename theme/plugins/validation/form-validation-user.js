jQuery(".form-valide").validate({
    ignore: [],
    errorClass: "invalid-feedback animated fadeInDown",
    errorElement: "div",
    errorPlacement: function (e, a) { jQuery(a).parents(".form-group > div").append(e) },
    highlight: function (e) { jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid") },
    success: function (e) { jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove() },
    
    rules:
    {
        "val-firstname": { required: !0, minlength: 3 },
        "val-othernames": { required: !0, minlength: 3 },
        "val-employeeNumber": { required: !0, minlength: 3 },
        "val-email": { required: !0, email: !0 },
        "val-telephone": { required: !0, telephone: !0 },
        "val-gender": { required: !0},
        "val-password": { required: !0, minlength: 5 },
        "val-confirm-password": { required: !0, equalTo: "#val-password" },
        "val-address": { required: !0, minlength: 5 },
        "val-nationality": {required: !0},
        "val-marital": { required: !0 },
        "val-identity-type": { required: !0 },
        "val-identity-number": { required: !0 },
        "val-staff-category": { required: !0 },
        "val-date-of-birth": {required: !0},
        
    },



    
    messages:
    {
        "val-firstname": { required: "Please enter first name", minlength: "Your firstname must consist of at least 3 characters" }, "val-othernames": { required: "Please enter other names", minlength: "Your othernames must consist of at least 3 characters" },
        "val-employeeNumber": { required: "Please enter employee number", minlength: "Your employee number must consist of at least 3 characters" },
        "val-email": "Please enter a valid email address",
        "val-telephone": "Please enter a valid telephone",
        "val-gender": "Please select a gender",
        "val-password": { required: "Please provide a password", minlength: "Your password must be at least 5 characters long" }, "val-confirm-password": { required: "Please provide a password", minlength: "Your password must be at least 5 characters long", equalTo: "Please enter the same password as above" },
        "val-address": { required: "Please enter your address", minlength: "Your address can not be less than 5 characters." },
        "val-nationality": "Please provide your nationality",
        "val-marital": "Please select a marital status",
        "val-identity-type": "Please select the Identity type",
        "val-identity-number": "Please enter user ID number / dirver's license number / passport number",
        "val-date-of-birth": "Please enter date of birth",
        "val-staff-category": "Please select staff category",
    }

});

