<h2 class="mb-4 text-center">Préférences</h2>

<form method="POST" action="?page=notifications">
    <div class="card">
        <div class="card-body p-0">
            <div class="d-flex justify-content-between align-items-center p-3 border-bottom border-secondary">
                <span class="fw-bold">Notifications globales</span>
                <label class="ios-switch">
                    <input type="checkbox" name="notif_global" checked>
                    <span class="ios-slider"></span>
                </label>
            </div>

            <div class="d-flex justify-content-between align-items-center p-3 border-bottom border-secondary">
                <span>Recevoir les e-mails</span>
                <label class="ios-switch">
                    <input type="checkbox" name="notif_email">
                    <span class="ios-slider"></span>
                </label>
            </div>

            <div class="d-flex justify-content-between align-items-center p-3">
                <span>Mode sombre</span>
                <label class="ios-switch">
                    <input type="checkbox" name="dark_mode" checked>
                    <span class="ios-slider"></span>
                </label>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <button type="submit" name="btn_update_notifs" class="btn btn-primary rounded-pill px-5">
            Enregistrer les préférences
        </button>
    </div>
</form>