import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		 './storage/framework/views/*.php',
		 './resources/**/*.blade.php',
		 './resources/**/*.js',
		 './resources/**/*.vue',
		 "./vendor/robsontenorio/mary/src/View/Components/**/*.php"
	],
    theme: {
        extend: {
            fontFamily: {
                omnes: ['"Omnes Regular"', 'sans-serif'],
                // You can also add other variations if needed
                omnesBold: ['"Omnes Bold"', 'sans-serif'],
            },
        },
    },
    plugins: [
		require("daisyui")
	],
};
