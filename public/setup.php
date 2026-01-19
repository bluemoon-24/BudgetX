<?php require_once '../app/Views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto text-center">
        <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Database Setup</h1>
        <p class="mt-4 text-lg text-gray-500">
            Click the button below to initialize the BudgetX database and tables.
        </p>
        <div class="mt-8">
            <form method="post">
                <button type="submit" name="setup_db"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Run Database Setup
                </button>
            </form>
        </div>

        <?php
        if (isset($_POST['setup_db'])) {
            try {
                // Connect without database selected
                $pdo = new PDO("mysql:host=localhost", "root", "");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = file_get_contents('../../database.sql');

                // Split SQL into individual queries because some PDO drivers don't support multiple queries in one call
                // But typically basic CREATE statements work or we can loop.
                // For simplicity, we'll try executing the raw content.
                // Ideally, we'd split by semicolon, but ; can be inside strings.
                // Given the simple schema, execution might work if the driver supports multi-statements (MySQL usually does).
        
                $pdo->exec($sql);

                echo '<div class="mt-4 p-4 bg-green-50 text-green-700 rounded-md">Database setup completed successfully! You can now <a href="/BudgetX/public/register" class="underline font-bold">Register</a></div>';

            } catch (PDOException $e) {
                echo '<div class="mt-4 p-4 bg-red-50 text-red-700 rounded-md">Error: ' . $e->getMessage() . '</div>';
            }
        }
        ?>
    </div>
</div>

<?php require_once '../app/Views/partials/footer.php'; ?>