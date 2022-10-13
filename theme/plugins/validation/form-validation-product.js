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
        "val-product-image": {required: !0},
        "val-unit-of-measure": {required: !0},
        "val-batch-number": {required: !0},
        "val-serial-number": {required: !0},
        "val-unit-cost": {required: !0},
        "val-e-extension": {required: !0},
        
    },



    
    messages:
    {
        "val-brand-name": { required: "Please enter product brand name", minlength: "Your product brand name must consist of at least 3 characters" },
        "val-manufacturer": { required: "Please enter product manufacturer", minlength: "Product manufacturer must consist of at least 3 characters" },
        "val-supplier": { required: "Please enter product supplier / distributor", minlength: "Product supplier or distributor must consist of at least 3 characters" },
        "val-point-of-origin": { required: "Please enter product point of origin.", minlength: "Point of origon must be atleast 2 characters long." },
        
        
        "val-date-of-manufacture": "Please enter date of manufacture",
        "val-date-of-expiry": "Please enter date of expiry",
        "val-product-image": "Please upload product image",
        "val-unit-of-measure": "Please enter product unit of measure",
        "val-batch-number": "Please enter product's batch number",
        "val-serial-number": "Please enter product serial number",
        "val-unit-cost": "please enter product unit cost",
        "val-e-extension": "Please enter product user guid (E-extension)",

    }

});

