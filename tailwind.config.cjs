// TODO: Add h --header-height to tailwind.config.js

// const defaultTheme = require("tailwindcss/defaultTheme");
const plugin = require("tailwindcss/plugin");
const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} config */
// https://tailwindcss.com/docs/configuration
module.exports = {
  content: ["./app/**/*.php", "./resources/**/*.{php,vue,js}"],
  theme: {
    extend: {
      container: {
        center: true,
        padding: {
          DEFAULT: "1rem",
          md: "1.5rem",
          sm: "2rem",
        },
      },
      colors: {
        black: "#000",
        white: "#fff",

        gray: {
          100: "#f6f6f6",
          200: "#888888",
          300: "#3c3c3c",
          1:"#2E2E2E",
        },
      },
      fontFamily: {
        sans: ["Roboto", ...defaultTheme.fontFamily.sans],
        serif: ["Lora", ...defaultTheme.fontFamily.serif],
        'gilroy-regular': ['Gilroy-Regular', 'sans-serif'],
      },
      lineHeight: {
        '1.875': '1.875rem',
      },
      fontWeight: {
        '400': 400,
      },
      fontSize: {
        base: ["16px", "24px"],
        lg: ["20px", "30px"],
        xl: ["32px", "38px"],
        "2xl": ["52px", { letterSpacing: "-0.4px", lineHeight: 1.25 }],
      },
      spacing: {
        '5/8': '55%',
      },
      // fontFamily: {
      //   sans: ["Basics", ...defaultTheme.fontFamily.sans],
      //   serif: ["Basics", ...defaultTheme.fontFamily.serif],
      // },
    },
  },
  plugins: [
    plugin(function ({ addComponents, theme }) {
      const layout = {
        ".basics-grid": {
          display: "grid",
          gridTemplateColumns: theme("gridTemplateColumns.8"),
          gap: theme("spacing.5"),
          '@screen lg': {
            gridTemplateColumns: theme("gridTemplateColumns.12"),
          },
        },
      };

      addComponents([layout]);
    }),
  ],
};
