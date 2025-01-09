<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Banque - Mes Comptes</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/umd/lucide.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-blue-600">Ma Banque</h1>
            </div>
            <nav class="mt-6">
                <a href="/Client" class="flex items-center w-full p-4 space-x-3 text-gray-600  hover:bg-gray-50">
                    <i data-lucide="wallet"></i>
                    <span>Tableau de bord</span>
                </a>
                <a href="/mcompte" class="flex items-center w-full p-4 space-x-3 bg-blue-50 text-blue-600 border-r-4 border-blue-600">
                    <i data-lucide="credit-card"></i>
                    <span>Mes comptes</span>
                </a>
                <a href="virement.html" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
                    <i data-lucide="send"></i>
                    <span>Virements</span>
                </a>
                <a href="benificier.html" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
                    <i data-lucide="users"></i>
                    <span>Bénéficiaires</span>
                </a>
                <a href="historique.html" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
                    <i data-lucide="history"></i>
                    <span>Historique</span>
                </a>
                <a href="/profeil" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
                    <i data-lucide="user"></i>
                    <span>Profil</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold text-gray-800">Mes Comptes</h2>

            <!-- Compte Courant -->
            <?php if (isset($account['courant'])):
                $compte_courant = $account['courant'];
            ?>
            <div class="mt-6 bg-white rounded-lg shadow">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Compte Courant</h3>
                            <p class="text-sm text-gray-500">ID° : <?= $compte_courant['id'] ?></p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-gray-900">€<?=$compte_courant['balance']?></p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Actif
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <button onclick="toggleModal('courant','Alimenter')" class="flex items-center justify-center p-3 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50">
                            <i data-lucide="plus-circle" class="w-5 h-5 mr-2"></i>
                            Alimenter
                        </button>
                        <button  onclick="toggleModal('courant','Retirer')"  class="flex items-center justify-center p-3 text-purple-600 border border-purple-600 rounded-lg hover:bg-purple-50">
                            <i data-lucide="download" class="w-5 h-5 mr-2"></i>
                            Retirer
                        </button>
                    </div>

                    <div class="mt-6">
                        <h4 class="font-medium text-gray-700">Détails du compte</h4>
                        <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm text-gray-500">Date d'ouverture</dt>
                                <dd class="mt-1 text-sm text-gray-900">15 janvier 2020</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-500">Plafond de retrait</dt>
                                <dd class="mt-1 text-sm text-gray-900">1000€ / jour</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-500">Découvert autorisé</dt>
                                <dd class="mt-1 text-sm text-gray-900">500€</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-500">Frais de tenue</dt>
                                <dd class="mt-1 text-sm text-gray-900">2€ / mois</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
            <?php endif ?>
            <?php if (isset($account['epargne'])): 
                $compte_epargne = $account['epargne'];
                ?>
                
            <!-- Compte Épargne -->
            <div class="mt-6 bg-white rounded-lg shadow">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Compte Épargne</h3>
                            <p class="text-sm text-gray-500">N° <?= $compte_epargne['id'] ?></p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-gray-900">€<?= $compte_epargne['balance'] ?></p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Actif
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <button onclick="toggleModal('epargne','Alimenter')" class="flex items-center justify-center p-3 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50">
                            <i data-lucide="plus-circle" class="w-5 h-5 mr-2"></i>
                            Alimenter
                        </button>
                        
                        <!-- Dans le Compte Épargne -->
                        <button onclick="toggleModal('epargne','Alimenter')" class="flex items-center justify-center p-3 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50">
                            <i data-lucide="plus-circle" class="w-5 h-5 mr-2"></i>
                            Alimenter
                        </button>
                    </div>

                    <div class="mt-6">
                        <h4 class="font-medium text-gray-700">Détails du compte</h4>
                        <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm text-gray-500">Date d'ouverture</dt>
                                <dd class="mt-1 text-sm text-gray-900">20 mars 2020</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-500">Taux d'intérêt</dt>
                                <dd class="mt-1 text-sm text-gray-900">2.5% annuel</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-500">Plafond</dt>
                                <dd class="mt-1 text-sm text-gray-900">50 000€</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-500">Frais de tenue</dt>
                                <dd class="mt-1 text-sm text-gray-900">Gratuit</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>

    <div id="alimenterCompteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 w-full max-w-md">
            <div class="bg-white rounded-lg shadow-xl">
                <!-- Modal header -->
                <div class="flex justify-between items-center p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Alimenter mon compte</h3>
                    <button onclick="hiddentoggleModal()" class="text-gray-400 hover:text-gray-500">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-6">
                    <form action="/AlimenterSolde" method="post" id="alimenterForm" class="space-y-6">
                        <!-- Sélection du compte -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Compte à alimenter *</label>
                            
                            <?php if (isset($account['courant'])): ?>
                                <input name="account_courant" type="hidden" value="<?= $account['courant']['id'] ?>">
                            <?php endif ?>
                            <?php if (isset($account['epargne'])) : ?>
                                <input name="account_epargne" type="hidden" value="<?= $account['epargne']['id'] ?>">
                            <?php endif ?>
                            <select name="accountSelected" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionnez un compte</option>
                                <?php if (isset($account['courant'])): ?>
                                    <option value="courant">Compte Courant - <?= $account['courant']['id'] ?> (<?= $account['courant']['balance'] ?> €)</option>
                                <?php endif ?>
                                <?php if (isset($account['epargne'])) : ?>
                                
                                    <option value="epargne">Compte Épargne - <?= $account['epargne']['id'] ?> (<?= $account['epargne']['balance'] ?> €)</option>
                                <?php endif ?>
                                
                            </select>
                        </div>

                        <!-- Montant -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Montant *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">€</span>
                                </div>
                                <input
                                    name="montant"
                                    type="number"
                                    required
                                    min="0.01"
                                    step="0.01"
                                    class="w-full pl-8 pr-12 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="0.00"
                                >
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Montant minimum : 0.01 €</p>
                        </div>

                        

                        <!-- Informations carte (affiché conditionnellement) -->
                        <!-- <div id="carteInfo" class="space-y-4 border-t pt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Numéro de carte *</label>
                                <input 
                                    type="text" 
                                    pattern="[0-9]{16}"
                                    maxlength="16"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="1234 5678 9012 3456"
                                >
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Date d'expiration *</label>
                                    <input 
                                        type="text" 
                                        pattern="(0[1-9]|1[0-2])\/([0-9]{2})"
                                        maxlength="5"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="MM/YY"
                                    >
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">CVV *</label>
                                    <input 
                                        type="text" 
                                        pattern="[0-9]{3}"
                                        maxlength="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="123"
                                    >
                                </div>
                            </div>
                        </div> -->

                        <!-- Message de confirmation -->
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i data-lucide="info" class="h-5 w-5 text-blue-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        Le montant sera crédité sur votre compte selon le mode de paiement choisi.
                                    </p>
                                </div>
                            </div>
                        </div>
                </div>

                <!-- Modal footer -->
                <div class="flex justify-end space-x-3 p-6 border-t bg-gray-50">
                    <button
                        onclick="hiddentoggleModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500"
                    >
                        Annuler
                    </button>
                    <button type="submit"
                        onclick="submitForm()"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        Confirmer l'alimentation
                    </button>
                </div>
                </form>

            </div>
        </div>
    </div>
    <div id="retirerArgent" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 w-full max-w-md">
            <div class="bg-white rounded-lg shadow-xl">
                <!-- Modal header -->
                <div class="flex justify-between items-center p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Retirer L'argent</h3>
                    <button onclick="hiddentoggleModal()" class="text-gray-400 hover:text-gray-500">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-6">
                    <form action="/AlimenterSolde" id="alimenterForm" class="space-y-6">
                        <!-- Sélection du compte -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Compte *</label>
                            <select name="ComteSelected" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionnez un compte</option>
                                <option value="courant">Compte Courant - FR76 1234 5678 9012 (2,450.50 €)</option>
                                <option value="epargne">Compte Épargne - FR76 9876 5432 1098 (15,750.20 €)</option>
                            </select>
                        </div>

                        <!-- Montant -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Montant *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">€</span>
                                </div>
                                <input
                                    name="MontantAlementer"
                                    type="number"
                                    required
                                    min="0.01"
                                    step="0.01"
                                    class="w-full pl-8 pr-12 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="0.00"
                                >
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Montant minimum : 0.01 €</p>
                        </div>

                        

  

                        <!-- Message de confirmation -->
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i data-lucide="info" class="h-5 w-5 text-blue-400"></i>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="flex justify-end space-x-3 p-6 border-t bg-gray-50">
                    <button
                        onclick="hiddentoggleModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500"
                    >
                        Annuler
                    </button>
                    <button
                        onclick="submitForm()"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        Confirmer
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        lucide.createIcons();
             // Fonction pour afficher/masquer le modal
function toggleModal(accountType,type_tansaction) {
    let modal;
    if (type_tansaction === 'Alimenter') {
        modal = document.getElementById('alimenterCompteModal');
    } else if (type_tansaction === 'Retirer'){
        modal = document.getElementById('retirerArgent');
    }
    modal.classList.toggle('hidden');
    
    if (accountType) {
        // Présélectionner le compte dans le select
        const selectAccount = modal.querySelector('select');
        selectAccount.value = accountType;
    }
}

function hiddentoggleModal(accountType,type_tansaction) {
    modal1 = document.getElementById('alimenterCompteModal');
    modal2 = document.getElementById('retirerArgent');
    modal1.classList.add('hidden');
    modal2.classList.add('hidden');
    
}

// Initialisation : masquer le bloc des informations de carte
document.getElementById('carteInfo').style.display = 'none';

// Gestion de l'affichage des champs de carte
document.querySelectorAll('input[name="paymentMethod"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const carteInfo = document.getElementById('carteInfo');
        carteInfo.style.display = this.value === 'carte' ? 'block' : 'none';
    });
});

// Fonction pour gérer la soumission du formulaire
function submitForm() {
    const form = document.getElementById('alimenterForm');
    if (form.checkValidity()) {
        // Traitement du formulaire ici
        alert('Alimentation effectuée avec succès !');
        hiddentoggleModal();
    } else {
        form.reportValidity();
    }
}

// Fermer le modal si on clique en dehors
window.onclick = function(event) {
    const modal = document.getElementById('alimenterCompteModal');
    if (event.target === modal) {
        hiddentoggleModal();
    }
}
    </script>
</body>
</html>