const CACHE_NAME = 'budgetx-v1';
const urlsToCache = [
    '/BudgetX/public/',
    '/BudgetX/public/css/output.css',
    '/BudgetX/public/login',
    '/BudgetX/public/register'
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                return cache.addAll(urlsToCache);
            })
    );
});

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                if (response) {
                    return response;
                }
                return fetch(event.request);
            })
    );
});
