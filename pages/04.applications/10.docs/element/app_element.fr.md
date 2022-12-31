---
title: Element
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_element'
---

[![Installer Element avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=element) [![Integration level](https://dash.yunohost.org/integration/element.svg)](https://dash.yunohost.org/appci/app/element)

*Element* est un nouveau type d'application de messagerie. Vous choisissez où vos messages sont stockés, ce qui vous donne le contrôle de vos données. Il vous donne accès au réseau ouvert Matrix, vous pouvez donc parler à n'importe qui. Element offre un nouveau niveau de sécurité, en ajoutant la vérification des appareils par signature croisée au chiffrement de bout en bout par défaut.

### Fonctionnalités spécifiques à YunoHost

Prise en charge multi-utilisateurs

Cette application prend en charge le SSO. Si vous souhaitez utiliser le SSO, vous devez définir le chemin d'accès au serveur domestique par défaut car votre serveur domestique est installé sur votre instance YunoHost.

### Informations supplémentaires

Note de sécurité importante

Nous vous déconseillons d'exécuter Element à partir du même nom de domaine que votre Matrix serveur domestique (Synapse). La raison en est le risque de XSS (cross-site-scripting) vulnérabilités qui pourraient survenir si quelqu'un provoquait le chargement et le rendu d'Element un utilisateur malveillant a généré du contenu à partir d'une API Matrix qui avait alors fait confiance accès à Element (ou à d'autres applications) en raison du partage du même domaine.

## Liens utiles

+ Site web : [element.io (fr)](https://element.io/)
+ Démonstration : [Démo](https://app.element.io/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/element](https://github.com/YunoHost-Apps/element_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/element/issues](https://github.com/YunoHost-Apps/element_ynh/issues)
