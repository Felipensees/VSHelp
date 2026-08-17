import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[type="password"]').forEach((input) => {
        if (input.dataset.passwordToggleInitialized === 'true') {
            return;
        }

        input.dataset.passwordToggleInitialized = 'true';

        const wrapper = document.createElement('div');
        wrapper.className = 'password-toggle-wrapper relative';

        const parent = input.parentNode;
        if (!parent) {
            return;
        }

        parent.insertBefore(wrapper, input);
        wrapper.appendChild(input);
        input.classList.add('pr-10');

        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'password-toggle-btn absolute inset-y-0 left-auto right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none';
        button.style.left = 'auto';
        button.style.right = '0.75rem';
        button.setAttribute('aria-label', 'Mostrar senha');
        button.innerHTML = `
            <svg class="password-eye-show h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            </svg>
            <svg class="password-eye-hide hidden h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M3 3l18 18"></path>
                <path d="M10.6 10.6A2 2 0 0 0 13.4 13.4"></path>
                <path d="M9.3 5.8A10.9 10.9 0 0 1 12 5c6.5 0 10 7 10 7a17.6 17.6 0 0 1-3.8 5.2"></path>
                <path d="M6.3 6.3A18 18 0 0 0 2 12s3.5 7 10 7a10.9 10.9 0 0 0 5.3-1.5"></path>
            </svg>
        `;

        button.addEventListener('click', () => {
            const isText = input.type === 'text';
            input.type = isText ? 'password' : 'text';
            button.setAttribute('aria-label', isText ? 'Mostrar senha' : 'Ocultar senha');

            const showIcon = button.querySelector('.password-eye-show');
            const hideIcon = button.querySelector('.password-eye-hide');

            if (showIcon && hideIcon) {
                showIcon.classList.toggle('hidden', !isText);
                hideIcon.classList.toggle('hidden', isText);
            }
        });

        wrapper.appendChild(button);
    });
});
