

$(() => {
    const user_name = document.getElementById("user_name");
    const new_password = document.getElementById("new_password");
    const confirm_new_password = document.getElementById("confirm_new_password");
    const show_password = document.getElementById("show_password");
    const input_array = [user_name, new_password, confirm_new_password];


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
    const check_required = (inputArr) => {
        inputArr.forEach(element => {
            if (element.value.length === 0) {
                show_error(element);
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
        if (new_password.type === "password") {
            new_password.type = "text"; 
            show_password.classList.remove("fa-eye");
            show_password.classList.add("fa-eye-slash");
        } else {
            new_password.type = "password";
            show_password.classList.add("fa-eye");
            show_password.classList.remove("fa-eye-slash");
        }
    })

    
// LOGINGING IN BUTTON CLICK
    $("#sign_in_btn").on('click', (e) => {
        if (user_name.value.trim() === "" || new_password.value.trim() === "" || confirm_new_password.value.trim()==="" ) {
            check_required(input_array);
        } else {
            if (new_password.value.trim() != confirm_new_password.value.trim()) {
                alert("Passwords do not match.");
            } else {
                
                $.ajax({
                    url: "./theme/APIs/password_reset_api.php",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        action: "password_rest",
                        user_name: user_name.value,
                        new_password: new_password.value,
                        confirm_new_password: confirm_new_password.value,
                    },
                    Cache: false,
                    success: (res) => {
                        alert(res['message']);
                        if (res['status'] === 'success') {
                            if (res['user_type'] === "admin") {
                                window.location.href = "./theme/admin/";
                            } else if (res['user_type'] === "dev") {
                                window.location.href = "./theme/dev/";
                            } else if (res['user_type'] === "supplier" || res['user_type'] === "consumer" || res['user_type'] === "producer") {
                                window.location.href = "../ukulima/";
                            }
                        }
                    },
                })
            }
        }

        e.preventDefault();
    })
})