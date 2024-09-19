import IMask from 'imask';

export const phoneMaskInit = () => {
    const phoneMask = {
        mask: "+{7}(000)000-00-00",
        lazy: false,
    };
    const phoneInputs = document.querySelectorAll("input[type=\"tel\"]");
    phoneInputs.forEach((input) => new IMask(input, phoneMask));
}

export const emailMaskInit = () => {
    const emailMask = {
        mask: function (value) {
            if (/^[a-z0-9_\.-]+$/.test(value)) return true;
            if (/^[a-z0-9_\.-]+@$/.test(value)) return true;
            if (/^[a-z0-9_\.-]+@[a-z0-9-]+$/.test(value)) return true;
            if (/^[a-z0-9_\.-]+@[a-z0-9-]+\.$/.test(value)) return true;
            if (/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}$/.test(value)) return true;
            if (/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}\.$/.test(value)) return true;
            if (/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}\.[a-z]{1,4}$/.test(value)) return true;
            return false;
        },
        lazy: false,
    };
    const emailInputs = document.querySelectorAll("input[type=\"email\"]");
    emailInputs.forEach((input) => new IMask(input, emailMask));
}
const validatorInit = () => {
    phoneMaskInit();
    emailMaskInit();

    const validateBeforeSubmit = document.querySelectorAll("form.validate-this");

    
    console.log(validateBeforeSubmit);

    validateBeforeSubmit.forEach((form) => {
        form.onsubmit = (e) => {
            e.preventDefault();
            // ????
            form.submit();
        }
    });



}
export default validatorInit;