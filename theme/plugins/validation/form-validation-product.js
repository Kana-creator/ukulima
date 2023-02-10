jQuery(".form-valide").validate({
    ignore: [],
    errorClass: "invalid-feedback animated fadeInDown",
    errorElement: "div",
    errorPlacement: function (e, a) { jQuery(a).parents(".form-group > div").append(e) },
    highlight: function (e) { jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid") },
    success: function (e) { jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove() },
    
    rules:
    {
        "val-brand-name": { required: !0, minlength: 3 },
        "val-manufacturer": { required: !0, minlength: 3 },
        "val-supplier": { required: !0, minlength: 3 },
        "val-point-of-origin": { required: !0, minlength: 2 },

        "val-date-of-manufacture": { required: !0 },
        "val-date-of-expiry": { required: !0},
        // "val-product-image": {required: !0},
        "val-unit-of-measure": {required: !0},
        "val-batch-number": {required: !0},
        "val-serial-number": {required: !0},
        "val-unit-cost": {required: !0},
        "val-e-extension": {required: !0},
        "val-product-category": {required: !0},
        "val-report-type": {required: !0},
        "val-report-details": {required: !0 },
        "val-branch-name": {required: !0 },
        "val-branch-number": { required: !0 },
        // "val-agency-number": {required: !0},
        "val-branch-address": { required: !0 },
        "val-contact-name": { required: !0 },
        "val-contact-number": { required: !0 },
        "val-contact-email": {required: !0}
        
        
    },



    
    messages:
    {
        "val-brand-name": { required: "Please enter product brand name", minlength: "Your product brand name must consist of at least 3 characters" },
        "val-manufacturer": { required: "Please enter product manufacturer", minlength: "Product manufacturer must consist of at least 3 characters" },
        "val-supplier": { required: "Please enter product supplier / distributor", minlength: "Product supplier or distributor must consist of at least 3 characters" },
        "val-point-of-origin": { required: "Please enter product point of origin.", minlength: "Point of origon must be atleast 2 characters long." },
        
        
        "val-date-of-manufacture": "Please enter date of manufacture",
        "val-date-of-expiry": "Please enter date of expiry",
        // "val-product-image": "Please upload product image",
        "val-unit-of-measure": "Please enter product unit of measure",
        "val-batch-number": "Please enter product's batch number",
        "val-serial-number": "Please enter product serial number",
        "val-unit-cost": "please enter product unit cost",
        "val-e-extension": "Please enter product user guid (E-extension)",
        "val-product-category": "This field is required! please enter a valid product category!",
        "val-report-type": "This field is required! please select a report type!",
        "val-report-details": "This field is required!",

        "val-branch-name": "This field is required please enter a valid branch name",
        "val-branch-number": "This field is required please enter a valid branch number",
        // "val-agency-number": "This field is required please enter a valid agency number",
        "val-branch-address": "This field is required please enter a valid branch location",
        "val-contact-name": "This field is required please enter a valid contact name",
        "val-contact-number": "This field is required please enter a valid contact number",
        "val-contact-email": "This field is required please enter a valid contact email"
  

    }

});

