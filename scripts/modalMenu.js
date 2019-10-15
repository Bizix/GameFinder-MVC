function toggleTabs() {
    let tabs = document.querySelectorAll(".head div");
    for (let i = 0; i < tabs.length; i++) {
        tabs[i].addEventListener("click", function (e) {
            e.preventDefault();
            let target = e.target;
            if (target.id == "signInTab") {
                toggleTabsStyle("block", "none", "transparent ", "lightgrey ");
                removeMsgs();

            } else if (target.id == "signUpTab") {
                toggleTabsStyle("none", "block", "lightgrey ", "transparent ");
                removeMsgs();
            }
        });
    }
}

function toggleTabsStyle(formLoginDisplay, formSignupDisplay, formLoginTabDisplay, formSignupTabDisplay) {
    let formLogin = document.querySelector("#signIn");
    let formLoginTab = document.querySelector("#signInTab");
    let formSignup = document.querySelector("#signUp");
    let formSignupTab = document.querySelector("#signUpTab");

    formLogin.style.display = formLoginDisplay;
    formSignup.style.display = formSignupDisplay;

    formLoginTab.style.background = formLoginTabDisplay;
    formSignupTab.style.background = formSignupTabDisplay;
}

function usernameInput(name) {
    if (name.value.length >= 4) {
        name.classList.add("correct");
        name.nextElementSibling.textContent = '';
    } else if (name.value === '') {
        name.classList.add("incorrect");
        name.nextElementSibling.textContent = 'The username is required';
    } else if (name.value < 4) {
        name.classList.add("incorrect");
        name.nextElementSibling.textContent = 'The username cannot be less than 4 characters';
    } else {
        name.classList.add("incorrect");
        name.nextElementSibling.textContent = 'The username cannot be less than 4 characters';
    }
}

function emailInput(mail) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail.value)) { //trim 
        mail.classList.add("correct");
        mail.nextElementSibling.textContent = '';
    } else if (mail.value === '') {
        mail.classList.add("incorrect");
        mail.nextElementSibling.textContent = 'Email is required';
    } else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail.value))) {
        mail.classList.add("incorrect");
        mail.nextElementSibling.textContent = 'please type a valid email: email@address.com';
    } else {
        mail.classList.add("correct");
        mail.nextElementSibling.textContent = '';
    }
}

function passwordInput(pwd) {

    if (pwd.value.length >= 6) {
        pwd.classList.add("correct");
        pwd.nextElementSibling.textContent = '';
    } else if (pwd.value === '') {
        pwd.classList.add("incorrect");
        pwd.nextElementSibling.textContent = 'The password is required';
    } else if (pwd.value.length < 6) {
        pwd.classList.add("incorrect");
        pwd.nextElementSibling.textContent = 'The password cannot be less than 6 characters';
    } else {
        pwd.classList.add("correct");
        pwd.nextElementSibling.textContent = '';
    }
}

function confirmPasswordInput(conf_pwd) {

    if (conf_pwd.value == password.value && conf_pwd.value != '') {
        conf_pwd.classList.add("correct");
        conf_pwd.nextElementSibling.textContent = '';
    } else if (conf_pwd.value == "") {
        conf_pwd.classList.add("incorrect");
        conf_pwd.nextElementSibling.textContent = 'Passwords must be confirmed';
    } else if (conf_pwd.value !== password.value) {
        conf_pwd.classList.add("incorrect");
        conf_pwd.nextElementSibling.textContent = 'Password must match';
    } else {
        conf_pwd.classList.add("correct");
        conf_pwd.nextElementSibling.textContent = '';
    }
}

function removeMsgs(form_signUp = document.getElementById('signUp'), form_signIn = document.getElementById('signIn')) {
    let inputs = [
        document.getElementById('username'),
        document.getElementById('email'),
        document.getElementById('psw'),
        document.getElementById('pswConfirm'),
    ];

    form_signUp.reset();
    form_signIn.reset();

    for (let i = 0; i < inputs.length; i++) {
        inputs[i].classList.remove("incorrect");
        inputs[i].classList.remove("correct");
    }

    let spans = document.querySelectorAll('.error');
    for (let i = 0; i < spans.length; i++) {
        spans[i].textContent = "";
    }
}


function loginWithKakao() {
    Kakao.Auth.loginForm({
        success: function (authObj) {
            Kakao.API.request({
                url: '/v2/user/me',
                success: function (res) {
                    // alert(JSON.stringify(res));
                    //into database 
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "../backend/signInDbAccess.php?=".res, true);
                    xhr.addEventListener("readystatechange", function (e) {
                        if (e.target.readyState === 4 && e.target.status === 200) {
                            console.log(xhr.responseText);
                        }
                    });
                    xhr.send();
                    // redirect the user to member area:
                    window.location.href = "./index.php";
                },
                fail: function (error) {
                    alert(JSON.stringify(error));
                }
            });
        },
        fail: function (err) {
            alert(JSON.stringify(err));
        },
        persistAccessToken: false
    });
}

// Member Area 

// Menu
function dropDown() {
    document.getElementById("profileMenuContent").classList.toggle("show");
}

/**
 * 
 * @param {*} inputList 
 * @param {*} sbmtButton 
 * @param {*} form 
 */
function checkFormSignUp(inputList, sbmtButton, form) {

    for (var i in inputList) {
        let input = inputList[i];
        input["input"].addEventListener(input["event"], input["func_to_call"]);
    }

    // error messages and checks
    sbmtButton.addEventListener('click', function (e) {
        e.preventDefault();
        let check = true;

        for (var i in inputList) {
            let input = inputList[i];
            if (input.value && input.value.length < input["condition"]) {
                input.nextElementSibling.textContent = input["textcontent"];
                check = false;
            }
        }

        if (inputList[2] != inputList[3]) {
            inputList[3].nextElementSibling.textContent = "Passwords must match";
            check = false;
        }

        (check) ? form.submit(): removeMsgs(form);
    });

}

function checkFormSignIn(inputs, submitBtn, form) {
    for (let i in inputs) {
        let input = inputs[i];

        input["input"].addEventListener(input["event"], function (e) {
            let target = e.target;
            target.classList.add("correct");
            target.classList.remove("incorrect");
            target.nextElementSibling.textContent = '';
            if (target.value === '' || target.value.length < input["condition"]) {
                target.classList.add("incorrect");
                target.classList.remove("correct");
                target.nextElementSibling.textContent = (target.value === '') ? input["textcontent_required"] : input["textcontent"];
            }
        });
    }

    submitBtn.addEventListener('click', function (e) {
        e.preventDefault();
        let check = true;
        for (var i in inputs) {
            let input = inputs[i];
            if (input.value && input.value.length < input["condition"]) {
                input.nextElementSibling.textContent = input["textcontent"];
                check = false;
            }
        }
        (check) ? form.submit(): removeMsgs(null, form);
    });
}

/**
 * 
 */
function closeModal() {
    let modalAboutUs = document.querySelector('#aboutus');
    let modalSignUp = document.querySelector('#signUpAndIn');
    let signupCancel = document.querySelector('#signupCancel');
    let signinCancel = document.getElementById('signinCancel');

    document.addEventListener("click", function (e) {
        if (e.target == modalAboutUs) {
            modalAboutUs.style.display = "none";
        }

        if (e.target == modalSignUp) {
            modalSignUp.style.display = "none";
        }
    });

    signupCancel.addEventListener('click', function (e) {
        removeMsgs();
    });

    signinCancel.addEventListener('click', function (e) {
        removeMsgs();
    });
}

/**
 * 
 */
function pwd_visibility() {
    let inputs = [{
            "eye_visibility": document.querySelector("#pwsignin"),
            "related_input": document.querySelector("#pwSignin"),
            "event": "click",
        },
        {
            "eye_visibility": document.querySelector("#pwtoggleSU"),
            "related_input": document.querySelector("#psw"),
            "event": "click",
        },
        {
            "eye_visibility": document.querySelector("#pwtoggleConf"),
            "related_input": document.querySelector("#pswConfirm"),
            "event": "click",
        },
    ];

    var pwInput = true;

    for (let i in inputs) {
        let input = inputs[i];
        input["eye_visibility"].addEventListener(input["event"], function (e) {
            let target = e.target;
            if (pwInput) {
                input["related_input"].setAttribute('type', 'text');
                target.innerHTML = '<i class="far fa-eye-slash"></i>';
            } else {
                input["related_input"].setAttribute('type', 'password');
                target.innerHTML = '<i class="far fa-eye"></i>';

            }
            pwInput = !pwInput;
        });
    }
}
// Kakao login

// initialization
function kakao_init() {
    Kakao.init('cd42352d6849f53b69a61e4f63da5fa4');
    console.log('is init :' + Kakao.isInitialized());
    console.log(Kakao.Auth.getStatus(function (statusObj) {
        console.log(statusObj)
    }));

    var kakaoLogin = document.querySelector('#kakaoLogin');


    kakaoLogin.addEventListener('click', function () {
        loginWithKakao();
    });
    var logOutbtn = document.getElementById("logOutbtn");
    if (logOutbtn) {
        logOutbtn.addEventListener("click", function () {
            Kakao.Auth.logout(console.log("You've been logged out"));
        });
    }
}

function show_dropDown() {
    window.onclick = function (event) {
        if (!event.target.matches('.dropbtn')) {
            let dropdowns = document.getElementsByClassName("profileMenu");
            for (var i = 0; i < dropdowns.length; i++) {
                let openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
}



/** EXECUTION */
function modal_init(inputs_to_check_signUp, inputs_to_check_signIn) {

    checkFormSignUp(inputs_to_check_signUp, document.getElementById('register'), document.getElementById('signUp'));
    checkFormSignIn(inputs_to_check_signIn, document.getElementById('signinBtn'), document.getElementById('signIn'));
    closeModal();
    toggleTabs();
    pwd_visibility();
    kakao_init();
    show_dropDown();
}

{
    // check the form 
    const inputs_to_check_signUp = [{
                "input": document.getElementById('username'),
                "event": "blur",
                "func_to_call": function (e) {
                    usernameInput(e.target);
                },
                "textcontent": "The username cannot be less than 4 characters",
                "condition": 4

            },
            {
                "input": document.getElementById('email'),
                "event": "blur",
                "func_to_call": function (e) {
                    emailInput(e.target);
                },
                "textcontent": "Email is required",
                "condition": ""
            },
            {
                "input": document.getElementById('psw'),
                "event": "blur",
                "func_to_call": function (e) {
                    passwordInput(e.target);
                },
                "textcontent": "The password cannot be less than 6 characters",
                "condition": 6
            },
            {
                "input": document.getElementById('pswConfirm'),
                "event": "blur",
                "func_to_call": function (e) {
                    confirmPasswordInput(e.target);
                },
                "textcontent": "Passwords must match",
                "condition": ""
            },

        ],

        inputs_to_check_signIn = [{
                "input": document.getElementById('signinusername'),
                "event": "blur",
                "func_to_call": "",
                "textcontent": "The username cannot be less than 4 characters",
                "textcontent_required": "The username is required",
                "condition": 4

            },
            {
                "input": document.getElementById('pwSignin'),
                "event": "blur",
                "func_to_call": "",
                "textcontent": "The password cannot be less than 6 characters",
                "textcontent_required": "The password is required",
                "condition": 6
            },
        ];

    modal_init(inputs_to_check_signUp, inputs_to_check_signIn);
}