// ===== Switching between Sign In & Sign Up =====
const signinBtn = document.querySelector('.signinBtn');
const signUPBtn = document.querySelector('.signupBtn');
const formBx = document.querySelector('.formBx');
var signin = document.querySelector('.signinForm');
var signup = document.querySelector('.signupForm');
signUPBtn.onclick = function() {
    formBx.classList.add('md:left-1/2', 'top-[90px]', 'md:top-0', 'rounded-bl-2xl', 'rounded-br-2xl', 'md:rounded-tr-2xl', 'md:rounded-bl-none');
    formBx.classList.remove('rounded-tl-2xl', 'rounded-tr-2xl', 'md:rounded-tr-none', 'md:rounded-bl-2xl');
    signup.classList.replace('hidden', 'flex');
    signin.classList.replace('flex', 'hidden');
}
signinBtn.onclick = function() {
    formBx.classList.remove('md:left-1/2', 'top-[90px]', 'md:top-0', 'rounded-bl-2xl', 'rounded-br-2xl', 'md:rounded-tr-2xl', 'md:rounded-bl-none');
    formBx.classList.add('rounded-tl-2xl', 'rounded-tr-2xl', 'md:rounded-tr-none', 'md:rounded-bl-2xl');
    signin.classList.replace('hidden', 'flex');
    signup.classList.replace('flex', 'hidden');
}

// ===== Form Validation =====
const signupInputs = document.querySelectorAll(".signup-input");
const signupParas = document.querySelectorAll(".signup-para");
const validation = {
    name: /^[a-z ]{3,32}$/i,
    username: /^[a-z\d]{5,16}$/i,
    email: /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
    password: /^(?=.*[\d])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d!@#$%^&*]{8,24}$/
};

function validate(field, regex) {
    if(regex.test(field.value)) {
        field.classList.remove("border-slate-900");
        field.classList.remove("border-red-0");
        field.classList.add("border-green-400");
    }else {
        field.classList.remove("border-slate-900");
        field.classList.add("border-red-0");
        field.classList.remove("border-green-400");
    }
}

for(var i = 0; i < (signupInputs.length - 1); i++) {
    let input = signupInputs[i];
    let signupPara = signupParas[i];

    input.addEventListener('keyup', function (evt) {
        //console.log(evt.target.attributes.name.value);
        let inputName = evt.target.attributes.name.value;

        validate(evt.target, validation[inputName]);
    });
    input.addEventListener('focus', function () {
        signupPara.classList.add("block");
        signupPara.classList.remove("hidden");
    });
    input.addEventListener('blur', function () {
        signupPara.classList.remove("block");
        signupPara.classList.add("hidden");
    });
}

const cPwd = signupInputs[signupInputs.length - 1];
const pwd = signupInputs[signupInputs.length - 2];
cPwd.addEventListener('keyup', function () {
    if(cPwd.value.length > 0) {
        if(cPwd.value === pwd.value) {
            cPwd.classList.remove("border-slate-900");
            cPwd.classList.remove("border-red-0");
            cPwd.classList.add("border-green-400");
        }else {
            cPwd.classList.remove("border-slate-900");
            cPwd.classList.add("border-red-0");
            cPwd.classList.remove("border-green-400");
        }
    }else {
        cPwd.classList.remove("border-slate-900");
        cPwd.classList.add("border-red-0");
        cPwd.classList.remove("border-green-400");
    }
})
