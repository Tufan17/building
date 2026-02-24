/** @type {import('tailwindcss').Config} */
module.exports = {
	darkMode: "class",
	content: ["./*.php", "./inc/**/*.php", "./template-parts/**/*.php", "./assets/**/*.js"],
	theme: {
		extend: {
			colors: {
				primary: "#C6A85A",
				"primary-dark": "#A68A4A",
				"background-light": "#f8f7f6",
				"background-dark": "#111827",
				"navy-dark": "#0B1120",
				"off-white": "#F9FAFB",
			},
			fontFamily: {
				display: ["Manrope", "sans-serif"],
				serif: ["Playfair Display", "serif"],
				newsreader: ["Newsreader", "serif"],
				noto: ["Noto Sans", "sans-serif"],
			},
			borderRadius: { DEFAULT: "0.25rem", lg: "0.5rem", xl: "0.75rem", full: "9999px" },
			spacing: { 128: "32rem" },
		},
	},
	plugins: [require("@tailwindcss/forms"), require("@tailwindcss/container-queries")],
}
