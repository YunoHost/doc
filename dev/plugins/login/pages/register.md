---
title: Register User
login_redirect_here: false
cache_control: private, no-cache, must-revalidate

form:

  fields:
    fullname:
      type: text
      validate:
        required: true


    username:
      type: text
      validate:
        required: true
        message: PLUGIN_LOGIN.USERNAME_NOT_VALID
        config-pattern@: system.username_regex

    email:
      type: email
      validate:
        required: true
        message: PLUGIN_LOGIN.EMAIL_VALIDATION_MESSAGE

    password1:
      type: password
      label: PLUGIN_LOGIN.ENTER_PASSWORD
      validate:
        required: true
        message: PLUGIN_LOGIN.PASSWORD_VALIDATION_MESSAGE
        config-pattern@: system.pwd_regex

    password2:
      type: password
      label: PLUGIN_LOGIN.ENTER_PASSWORD_AGAIN
      validate:
        required: true
        message: PLUGIN_LOGIN.PASSWORD_VALIDATION_MESSAGE
        config-pattern@: system.pwd_regex

  buttons:
      -
          type: submit
          value: PLUGIN_LOGIN.BTN_REGISTER
      -
          type: reset
          value: PLUGIN_LOGIN.BTN_RESET

  process:
      register_user: true
      message: PLUGIN_LOGIN.REGISTRATION_THANK_YOU
      reset: true
---

# Register

Create a new user account by entering all the required fields below:
