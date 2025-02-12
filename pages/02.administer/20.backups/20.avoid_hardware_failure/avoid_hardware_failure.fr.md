---
title: Éviter les pannes matérielles
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/avoid_hardware_failure'
page-toc:
  active: true
  depth: 3
---

## Sécuriser physiquement votre serveur

Très souvent les personnes qui s'autohébergent n'ont pas de rangement correct pour leur système. Laisser le serveur en plusieurs parties, dans un lieu de passage, accessible à des enfants ou des animaux, ou dans un endroit peu aéré peut vite tourner à la catastrophe.

## Fixer vos disques durs

Idéalement, vos disques durs doivent être fixés pour éviter les vibrations qui peuvent accélérer l'usure du matériel voire atténuer ses performances, notamment s'il y a un autre disque à côté.

## Réduire la swapiness pour les cartes SD et disques SSD

Si vous utilisez un fichier de swap avec un SSD ou une carte SD avec une swapiness trop élevée, votre support de stockage pourrait rendre l'âme prématurément en raison d'un trop grand nombre d'écritures.

Pour éviter ça:

```bash
cat /proc/sys/vm/swappiness
```

Si elle est au-dessus de 10:

```bash
sysctl vm.swappiness=10
nano /etc/sysctl.conf
```

Si la ligne est présente, changez la valeur vm.swappiness à 10.Sinon, ajoutez la ligne:

```text
vm.swappiness = 10
```

## Redondance de stockage

Afin de limiter les pannes matérielles des supports de stockage, il peut être pertinent de mettre en place une grappe de disques en miroir (RAID, ZFS). L'idée ici est que tout ce qui est écrit sur un disque le sera sur l'autre. Ainsi, si l'un tombe en panne, l'autre continue de fonctionner et le serveur est toujours pleinement fonctionnel.

Il existe aussi des grappes plus évoluées qui maximisent la tolérance de panne (panne de 2 disques comme le RAID6) ou le stockage (voir RAID 5).

Toutefois, ces techniques de grappes de disques ne devraient pas être considérées comme des copies de sauvegarde. Une grappe RAID devrait être considérée comme un seul support de stockage. En effet, si cette technique permet d'éviter de devoir réinstaller en cas de crash probable d'un disque, on est loin du risque zéro.

Quelques exemples de situations connues des administrateurs systèmes professionnels:

- les disques d'une grappe montée avec des disques de la même marque peuvent tomber en panne quasiment en même temps en moins de quelques heures
- sans monitoring de la santé des disques, il y a de fortes chances que l'on ne remarque la panne d'un disque de la grappe que lorsqu'un deuxième tombe en panne (><)
- si on n'a pas de disque de rechange, le délai d'achat peut aboutir à un crash de l'autre disque
- un disque à moitié fonctionnel qui produit des erreurs peut propager son erreur à travers la grappe
- les connectiques des disques ou le contrôleur RAID peuvent produire des erreurs aussi ou tomber en panne
- plus on complexifie l'architecture avec de nombreux composants, plus il y a de chances que l'un d'eux tombe en panne

!!! Si vous souhaitez mettre en place une grappe RAID ou utiliser btrfs, le plus simple est de le faire à l'installation avec l'iso YunoHost en mode expert (lors du partitionnement du système).
