---
title: Login
cache_control: private, no-cache, must-revalidate

login_redirect_here: false

forms:
  login:
    action:
    method: post

    fields:
        username:
          type: text
          id: username
          placeholder: PLUGIN_LOGIN.USERNAME_EMAIL
          label: PLUGIN_LOGIN.USERNAME_EMAIL
          autofocus: true

        password:
          type: password
          id: password
          placeholder: PLUGIN_LOGIN.PASSWORD
          label: PLUGIN_LOGIN.PASSWORD

  login-twofa:
    action:
    method: post

    fields:
      2fa_instructions:
          type: display
          markdown: true
          content: PLUGIN_LOGIN.2FA_INSTRUCTIONS
      2fa_code:
          type: text
          id: twofa-code
          autofocus: true
          placeholder: PLUGIN_LOGIN.2FA_CODE_INPUT
---

# User Login
