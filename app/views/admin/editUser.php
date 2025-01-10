<?php include __DIR__ . '/../partials/admin/sidebar.php'; ?>

<div id="editUserModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-10 mx-auto p-5 w-full max-w-2xl">
        <div class="bg-white rounded-lg shadow-xl">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Modifier les informations de l'utilisateur</h3>
                <button onclick="" class="text-gray-400 hover:text-gray-500">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <form action="/admin/editAccount/" method="POST" id="editUserForm" class="space-y-6">
                    <!-- Informations utilisateur -->
                    <div>
                        <h4 class="text-base font-medium text-gray-900 mb-4">Informations utilisateur</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                                <input name="name" value="<?php echo $user['name']; ?>" type="text"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ID utilisateur *</label>
                                <input name="UserId" value="<?php echo $user['id']; ?>"
                                    type="text"
                                    readonly
                                    class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                <input name="email" value="<?php echo $user['email']; ?>"
                                    type="email"
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Types de comptes -->
                    <div>
                        <h4 class="text-base font-medium text-gray-900 mb-4">Gestion des comptes</h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Types de comptes *</label>
                                <?php for ($i = 0; $i < count($userAccounts); $i++): ?>
                                    <div id="accountTypes" class="space-y-2">
                                        <div class="flex items-center space-x-4 space-y-3">
                                            <span class="text-gray-800">
                                            <?php echo $userAccounts[$i]["account_type"]; ?></span>
                                            <button type="button" class="px-2 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600" onclick="disableAccount()">Désactiver</button>
                                            <button type="button" class="px-2 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600" onclick="deleteAccount()">Supprimer</button>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ajouter un type de compte</label>
                                <?php
                                $hasCourant = false;
                                $hasEpargne = false;

                                foreach ($userAccounts as $account) {
                                    if ($account["account_type"] === "courant") {
                                        $hasCourant = true;
                                    } elseif ($account["account_type"] === "epargne") {
                                        $hasEpargne = true;
                                    }
                                }

                                $accountTypeToShow = null;
                                if ($hasCourant && !$hasEpargne) {
                                    $accountTypeToShow = "epargne";
                                } elseif ($hasEpargne && !$hasCourant) {
                                    $accountTypeToShow = "courant";
                                }

                                if ($accountTypeToShow !== null) {
                                ?>
                                    <select name="newAccountType" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Sélectionner</option>
                                        <option value="<?php echo $accountTypeToShow; ?>">
                                            Compte <?php echo $accountTypeToShow; ?>
                                        </option>
                                    </select>
                                    <button type="button" class="mt-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500" onclick="addAccountType()">Ajouter</button>
                            
                                <?php
                                } else {
                                    echo "Vous avez déjà les deux types de comptes.";
                                }
                                ?>
                                </div>
                        </div>
                    </div>

                    <!-- Solde -->
                    <div>
                        <h4 class="text-base font-medium text-gray-900 mb-4">Solde</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Solde actuel</label>
                                <input name="CurrentBalance" value="" class="w-full px-3 py-2 border border-gray-300"
                                    type="text"
                                    readonly
                                    class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ajouter au solde</label>
                                <input name="AddBalance"
                                    type="number"
                                    step="0.01"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end space-x-3 p-6 border-t bg-gray-50">
                        <button onclick="ToggleEditMenu()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>