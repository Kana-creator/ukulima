
$(() => {
    const first_name = document.getElementById("first_name");
    const last_name = document.getElementById("last_name");
    const user_email = document.getElementById("user_email");
    const user_telephone = document.getElementById("user_telephone");
    const user_password = document.getElementById("user_password");
    const confirm_password = document.getElementById("confirm_password");
    const show_password = document.getElementById("show_password");
    const user_category = document.getElementById("user-category");
    const user_gender = document.getElementById("user_gender");

    const input_array = [first_name, last_name, user_email, user_telephone, user_password, confirm_password];

    const select_array = [user_category, user_gender];

    
    // showing error message 
    const show_error = input => {
        const form_group = input.parentElement;
        const small = form_group.querySelector("small");
        small.classList.add("active");
        small.innerText = "This field is required.";
        const label = form_group.querySelector("label").classList.remove("active");
        form_group.classList.add("error");
       
    }

    // removing error message
    const show_success = input => {
        const form_group = input.parentElement;
        const small = form_group.querySelector("small").classList.remove("active");
        const label = form_group.querySelector("label").classList.add("active");
        form_group.classList.remove("error");
    }

    // checking required fields
    const check_required = (inputArray, e) => {
        inputArray.forEach(element => {
            if (element.value.length === 0) {
                show_error(element);
            } else {
                show_success(element);
            }

        })

    }

    // showing required fields on text input
    input_array.forEach(input => {
        input.addEventListener('keyup', () => {
            check_required(input_array.concat(select_array));
        });
    });

    


    // SHOWING REQIRED SELECT FIELDS
    select_array.forEach(input => {
        input.addEventListener('change', () => {
            check_required(select_array.concat(input_array));
        });
    });


    // SHOWING AND HIDING PASSWORD
    show_password.addEventListener('click', () => {
        if (user_password.type === "password") {
            user_password.type = "text";
            show_password.classList.remove('fa-eye');
            show_password.classList.add('fa-eye-slash');
            
        } else {
            user_password.type = "password";
            show_password.classList.add('fa-eye');
            show_password.classList.remove('fa-eye-slash');
        }
    });


    // sign up buttton click
    $("#signup_btn").on('click', (e) => {
        if (first_name.value.trim() == "" || last_name.value.trim() == "" || user_email.value.trim() == "" || user_telephone.value.trim() == "" || user_password.value.trim() == "" || confirm_password.value.trim() == "" || user_category.value.trim() == "" || user_gender.value.trim() == "") {
            check_required(input_array.concat(select_array), e);
        } else {
            $.ajax({
                url: "../APIs/sign_up_api.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    action: "sign_up",
                    first_name: first_name.value,
                    last_name: last_name.value,
                    user_email: user_email.value, 
                    user_telephone: user_telephone.value,
                    user_password: user_password.value,
                    confirm_password: confirm_password.value,
                    user_category: user_category.value,
                    user_gender: user_gender.value

                },
                async: true,
                Cache: false,
                success: (res) => {
                    document.getElementById("message_div").classList.add('active');
                    document.getElementById("alert_msg").innerText = res['msg'];                        
                    var alert_icon = document.getElementById("alert_icon");
                    if (res['status'] === "error") {
                        alert_icon.classList.remove("fa-chack");
                        alert_icon.classList.add("fa-warning");
                        
                    } else {
                        alert_icon.classList.add("fa-chack");
                        alert_icon.classList.remove("fa-warning"); 
                    }
                    $("#ok").on('click', () => {
                        if (res['status'] === 'error') {
                            document.getElementById("message_div").classList.remove('active');
                            
                        } else {
                            window.location.href = "/ukulima/theme/dev";
                        }
                    })
                }
            });

        }
            e.preventDefault();
    });
});