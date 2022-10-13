

$(() => {
    const user_name = document.getElementById("user_name");
    const password = document.getElementById("password");
    const show_password = document.getElementById("show_password");
    const input_array = [user_name, password];


    // FUNCTION FOR SHOWING ERRROR MESSAGE
    const show_error = (input) => {
        const form_group = input.parentElement;
        form_group.classList.add("active");
    }


    const show_success = (input) => {
        const form_group = input.parentElement;
        form_group.classList.remove("active");
    }
        

    // FUNCNTION FOR CHECKING EMPTY FIELDS
    const check_required = (inputArr, e) => {
        inputArr.forEach(element => {
            if (element.value.length === 0) {
                show_error(element);
                e.preventDefault();
            } else {
                show_success(element)
            }

        });
    }


    // SHOWING REQUIRED FIELDS ON TEXT INPUT
    input_array.forEach(input => {
        input.addEventListener('keyup', () => {
            check_required(input_array);
        })
    })


    // SHOWING AND HIDDING PASSWORD 
    $("#show_password").on('click', () => {
        if (password.type === "password") {
            password.type = "text"; 
            show_password.classList.remove("fa-eye");
            show_password.classList.add("fa-eye-slash");
        } else {
            password.type = "password";
            show_password.classList.add("fa-eye");
            show_password.classList.remove("fa-eye-slash");
        }
    })

    
// LOGINGING IN BUTTON CLICK
    $("#sign_in_btn").on('click', (e) => {
        check_required(input_array, e);
        alert("Congratulations Anatoli for this awesome programming.");
    })
})