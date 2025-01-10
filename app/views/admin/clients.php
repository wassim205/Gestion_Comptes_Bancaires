<?php include __DIR__ . '/../partials/admin/sidebar.php'; ?>

<!-- Main Content -->
<div class="flex-1">
    <!-- Top Navigation -->
    <div class="bg-white shadow">
        <div class="px-8 py-4 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 ml-2">Gestion des Clients</h2>
            <button
                onclick="toggleAddClientModal()"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
                <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
                Nouveau Client
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="p-8">
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                    <div class="relative">
                        <input
                            type="text"
                            placeholder="Nom, email, ID..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-3 top-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Client List -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <table class="min-w-full">
                    <thead>
                        <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th class="p-3">Client</th>
                            <th class="p-3">Contact</th>
                            <th class="p-3">Comptes</th>
                            <th class="p-3">Statut</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($users as $user): ?>
                            <!-- Client 1 -->
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">
                                    <div class="flex items-center">
                                        <img src="<?php echo $user["profile_pic"] ?>" alt="Thomas Robert" class="w-12 h-12 rounded-full">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <h1><?php echo $user["name"] ?></h1>
                                            </div>
                                            <div class="text-sm text-gray-500">ID: <?php echo $user["id"] ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3">
                                    <div class="text-sm text-gray-900 font-semibold"><?php echo $user["email"] ?></div>
                                </td>
                                <td class="p-3">
                                    <div class="text-sm text-gray-900"><?php echo $user["account_count"] . " comptes" ?></div>
                                    <div class="text-sm text-gray-500"><?php echo $user["account_types"] ?></div>
                                </td>
                                <td class="p-3">
                                    <form action="">
                                        <a href="/admin/change-status/<?php echo $user["id"]; ?>/<?php echo ($user["status"] == "actif") ? "inactif" : "actif"; ?>">
                                            <?php if ($user["status"] == "actif"): ?>
                                                <span class="user-status cursor-pointer px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    <?php echo $user["status"]; ?>
                                                </span>
                                            <?php elseif ($user["status"] == "inactif"): ?>
                                                <span class="user-status cursor-pointer px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    <?php echo $user["status"]; ?>
                                                </span>
                                            <?php endif; ?>
                                        </a>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="">
                                        <a href="/admin/editAccount/<?php echo $user["id"]; ?>" id="editButton" onclick="ToggleEditMenu()" class="px-2 text-md font-semibold text-blue-800">Edit</a>
                                        <a href="/admin/deleteUser/<?php echo $user["id"]; ?>" class="px-2 text-md font-semibold text-red-800">Delete</a>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- add client  -->

                <div id="addClientModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
                    <div class="relative top-10 mx-auto p-5 w-full max-w-2xl">
                        <div class="bg-white rounded-lg shadow-xl">
                            <!-- Modal Header -->
                            <div class="flex justify-between items-center p-6 border-b">
                                <h3 class="text-lg font-semibold text-gray-900">Ajouter un nouveau client</h3>
                                <button onclick="toggleAddClientModal()" class="text-gray-400 hover:text-gray-500">
                                    <i data-lucide="x" class="w-6 h-6"></i>
                                </button>
                            </div>

                            <!-- Modal Body -->
                            <div class="p-6">
                                <form action="/admin/addingAUser" method="POST" id="addClientForm" class="space-y-6">
                                    <!-- Informations personnelles -->
                                    <div>
                                        <h4 class="text-base font-medium text-gray-900 mb-4">Informations personnelles</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
                                                <input name="SecondName"
                                                    type="text"
                                                    required
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Prénom *</label>
                                                <input name="FirstName"
                                                    type="text"
                                                    required
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Date de naissance</label>
                                                <input
                                                    type="date"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Nationalité</label>
                                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    <option value="">Sélectionner</option>
                                                    <option value="fr">Française</option>
                                                    <option value="other">Autre</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Coordonnées -->
                                    <div>
                                        <h4 class="text-base font-medium text-gray-900 mb-4">Coordonnées</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                                <input name="Email"
                                                    type="email"
                                                    required
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                                                <input name="password"
                                                    type="password"
                                                    required
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone </label>
                                                <input
                                                    type="tel"

                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Code postal</label>
                                                <input
                                                    type="text"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Type de compte -->
                                    <div>
                                        <h4 class="text-base font-medium text-gray-900 mb-4">Configuration du compte</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Type de compte *</label>
                                                <select name="account_type" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    <option value="">Sélectionner</option>
                                                    <option value="courant">Compte Courant</option>
                                                    <option value="epargne">Compte Épargne</option>
                                                    <option value="both">Les deux</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Conseiller assigné</label>
                                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    <option value="">Sélectionner</option>
                                                    <option value="1">Marc Dubois</option>
                                                    <option value="2">Sophie Martin</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Footer -->
                                    <div class="flex justify-end space-x-3 p-6 border-t bg-gray-50">
                                        <button
                                            onclick="toggleAddClientModal()"
                                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                            Annuler
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            Créer le compte
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>




</body>

</html>