// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.9.1/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.9.1/firebase-analytics.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyCIcp3iPSLb2_Nu3gtazteyb-BESSUJoLo",
  authDomain: "alf-laylaa.firebaseapp.com",
  projectId: "alf-laylaa",
  storageBucket: "alf-laylaa.firebasestorage.app",
  messagingSenderId: "606743366322",
  appId: "1:606743366322:web:4817f66f8cc5fc759997ab",
  measurementId: "G-7G2D56WVEB",
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

