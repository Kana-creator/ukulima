
$(() => {
    const first_name = document.getElementById("first_name");
    const last_name = document.getElementById("last_name");
    const user_email = document.getElementById("user_email");
    const user_telephone = document.getElementById("user_telephone");
    const user_password = document.getElementById("user_password");
    const confirm_password = document.getElementById("confirm_password");
    const show_password = document.getElementById("show_password");
    const user_category = document.getElementById("user-category");

    const input_array = [first_name, last_name, user_email, user_telephone, user_password, confirm_password, user_category];

    
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
                e.preventDefault();
            } else {
                show_success(element);
            }

        })
    }

// showing required fields on text input
    input_array.forEach(input => {
        input.addEventListener('keyup', () => {
            check_required(input_array);
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
        check_required(input_array, e);
    });
})