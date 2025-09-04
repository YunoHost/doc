/*
Most of this file is taken from https://github.com/lullaby6/language-redirect under the MIT license (many thanks to them!)
 */

window.languageRedirect = redirects => {
    redirects = Object.keys(redirects).reduce((acc, key) => {
        acc[key.toLowerCase()] = redirects[key];
        return acc;
    }, {});

    const currentPath = window.location.pathname;

    // if the doc is already on a locale path, do not redirect
    if (Object.keys(redirects).some(locale => currentPath.startsWith(`/${locale}`))) {
        return;
    }

    const data = {
        user_language: navigator.language || navigator.userLanguage,
        short_language: (navigator.language || navigator.userLanguage).split('-')[0]
    }

    Object.values(data).forEach(language => {
        const redirect = redirects[language]

        if (
            !redirect ||
            redirect === window.location.pathname ||
            `/${redirect}` === window.location.pathname ||
            redirect === window.location.href
        ) return

        window.location.replace(redirect)
    })

    return data
}


if (
    document &&
    document.currentScript &&
    document.currentScript.src &&
    document.currentScript.dataset.languageRedirect
) {
    try {
        window.languageRedirect(JSON.parse(document.currentScript.dataset.languageRedirect))
    } catch (error) {
        console.error(error)
    }
}