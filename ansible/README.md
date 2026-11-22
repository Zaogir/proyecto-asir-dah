# Automatització amb Ansible

Tres playbooks per mantenir els servidors del projecte operatius i avisar l'administrador per correu:

| Playbook | Què fa |
|---|---|
| `check_connection.yml` | Comprova que cada màquina respon (`wait_for_connection`) i, si no, envia un correu. |
| `check_network.yml` | Fa `ping` a cada màquina i avisa si alguna és inabastable. |
| `update_package.yml` | Executa l'actualització d'`apt` com a root i envia un correu de confirmació o d'error. |

## Ús

```bash
ansible-galaxy collection install community.general
cp group_vars_all.example.yml group_vars/all.yml      # edita smtp_user i admin_email
ansible-vault create group_vars/vault.yml             # dins: emailPass: "<contrasenya d'aplicació de Gmail>"
ansible-playbook -i inventory.example.ini check_connection.yml --ask-vault-pass -e @group_vars/vault.yml
```

La contrasenya del correu es guarda amb **Ansible Vault** (variable `emailPass`) perquè no quedi mai en text pla.

> Nota: a `update_package.yml` el correu de «actualització completada» només s'envia si el servidor és accessible (a l'original s'enviava sempre).
>
> Transcrits a partir de les captures de la memòria; adreces i credencials originals substituïdes per variables.
