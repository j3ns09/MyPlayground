function getUserRole(role) {
    role = parseInt(role, 10);
    
    switch (role) {
      case 0:
          roleString = 'Joueur';
          break;
      case 1:
          roleString = 'Arbitre';
          break;
      case 2:
          roleString = 'Organisateur';
          break;
      case 3:
          roleString = 'Spectateur';
          break;
      default:
          roleString = 'Inconnu';
          break;
    }

    return roleString;
}

function getUserLevel(level) {
    level = parseInt(level, 10);

    switch (level) {
      case 0:
        level = 'Débutant';
        break;
      case 1:
        level = 'Intérmediaire';
        break;
      case 2:
        level = 'Avancé';
        break;
      case 3:
        level = 'Pro';
        break;
      default:
        level = 'Inconnu';
        break;
    }

    return level;
}

function getUserPosition(poste) {
    poste = parseInt(poste, 10);

    switch (poste) {
        case 0:
            poste = 'Meneur de jeu';
            break;
        case 1:
            poste = 'Arrière';
            break;
        case 2:
            poste = 'Ailier';
            break;
        case 3:
            poste = 'Ailier fort';
            break;
        case 4:
            poste = 'Pivot';
            break;
        default:
            poste = 'Inconnu';
            break;
    }

    return poste;
}

document.addEventListener('DOMContentLoaded', async function () {
    const response = await fetch("/api/users/banned/", {
            method: 'GET'
    });

    const tbody = document.querySelector('#bannedUsersShowing');

    const data = await response.json();
    
    const users = data.users;
    const userIdSession = data.waiter;

    for (const user of users) {
        const id = user.id;
        const username = user.pseudo;
        const nom = user.nom;
        const prenom = user.prenom;
        const email = user.email;
        const role = getUserRole(user.role);
        const reason = user.raison;
        const bannedOn = user.date_debut;
        const endBan = user.date_fin;
        const banCount = user.ban_count;

        user.niveau = parseInt(user.niveau);
        user.poste = parseInt(user.poste);
        user.role = parseInt(user.role);


        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${username}</td>
            <td>${nom}</td>
            <td>${prenom}</td>
            <td>${email}</td>
            <td>${role}</td>
            <td>${reason}</td>
            <td>${bannedOn}</td>
            <td>${endBan ?? "Indéfini"}</td>
            <td>${banCount} fois</td>
            <td>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProfile${id}"}><i class="bi bi-pencil-fill"></i></button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProfile${id}"><i class="bi bi-trash3-fill"></i></button>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#unbanProfile${id}"><i class="bi bi-unlock2-fill"></i></button>
                ${generateDeleteModal(id)}
                ${generateEditModal(id, user)}
                ${generateUnbanModal(id, user)}
            </td>
        `;
        tbody.appendChild(tr);
    };

    function generateDeleteModal(id) {
        return `
        <div class="modal fade" id="deleteProfile${id}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form method="POST" action="../../processes/delete_user_process.php">
                <div class="modal-header">
                  <h5 class="modal-title">Supprimer un profil</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Êtes-vous sûr de vouloir supprimer cet utilisateur ?
                  <input type="hidden" name="id" value="${id}">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                  <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
              </form>
            </div>
          </div>
        </div>`;
    }

    function generateUnbanModal(id) {
        return `
        <div class="modal fade" id="unbanProfile${id}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form method="POST" action="../../processes/unban_user_process.php">
                <div class="modal-header">
                  <h5 class="modal-title">Grâcier un profil</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Êtes-vous sûr de vouloir grâcier cet utilisateur ?
                  <input type="hidden" name="id" value="${id}">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                  <button type="submit" class="btn btn-danger">Valider</button>
                </div>
              </form>
            </div>
          </div>
        </div>`;
    }

    function generateEditModal(id, user) {
        return `
        <div class="modal fade" id="editProfile${id}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form method="POST" action="../../processes/edit_profile_from_admin_process.php">
                <div class="modal-header">
                  <h5 class="modal-title">Modifier un profil</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="id" value="${id}">
                  <div class="mb-3"><label>Nom</label><input name="nom" class="form-control" value="${user.nom}" /></div>
                  <div class="mb-3"><label>Prénom</label><input name="prenom" class="form-control" value="${user.prenom}" /></div>
                  <div class="mb-3"><label>Nom d'utilisateur</label><input name="pseudo" class="form-control" value="${user.pseudo}" /></div>
                  <div class="mb-3"><label>Téléphone</label><input name="tel" class="form-control" value="${user.tel}" /></div>
                  <div class="mb-3"><label>Email</label><input name="email" class="form-control" value="${user.email}" /></div>
                  <div class="mb-3"><label>Adresse</label><input name="localisation" class="form-control" value="${user.localisation}" /></div>
                  
                  <div class="mb-3">
                  <label>Niveau</label>
                    <select name="niveau" class="form-select">
                      <option value="0" ${user.niveau === 0 ? 'selected' : ''}>Débutant</option>
                      <option value="1" ${user.niveau === 1 ? 'selected' : ''}>Intermédiaire</option>
                      <option value="2" ${user.niveau === 2 ? 'selected' : ''}>Avancé</option>
                      <option value="3" ${user.niveau === 3 ? 'selected' : ''}>Pro</option>
                    </select>
                  </div>

                  <div class="mb-3">
                  <label>Poste</label>
                    <select name="poste" class="form-select">
                      <option value="0" ${user.poste === 0 ? 'selected' : ''}>Meneur de jeu</option>
                      <option value="1" ${user.poste === 1 ? 'selected' : ''}>Arrière</option>
                      <option value="2" ${user.poste === 2 ? 'selected' : ''}>Ailier</option>
                      <option value="3" ${user.poste === 3 ? 'selected' : ''}>Ailier fort</option>
                      <option value="4" ${user.poste === 4 ? 'selected' : ''}>Pivot</option>
                    </select>
                  </div>

                  <div class="mb-3">
                  <label>Rôle</label>
                    <select name="role" class="form-select">
                      <option value="0" ${user.role === 0 ? 'selected' : ''}>Joueur</option>
                      <option value="1" ${user.role === 1 ? 'selected' : ''}>Arbitre</option>
                      <option value="2" ${user.role === 2 ? 'selected' : ''}>Organisateur</option>
                      <option value="3" ${user.role === 3 ? 'selected' : ''}>Spectateur</option>
                    </select>
                  </div>

                  <div class="mb-3"><label>Commentaire</label><textarea name="commentaire" class="form-control">${user.description}"</textarea></div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                  <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
              </form>
            </div>
          </div>
        </div>`;
    }
});
