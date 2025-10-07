// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { getFirestore } from "firebase/firestore";

const firebaseConfig = {
  apiKey: "AIzaSyCnkvmAWaq2XUYBP1Uax3RfFHGhEKy88fY",
  authDomain: "e-commercereact-e63b0.firebaseapp.com",
  projectId: "e-commercereact-e63b0",
  storageBucket: "e-commercereact-e63b0.firebasestorage.app",
  messagingSenderId: "798077923957",
  appId: "1:798077923957:web:29478534f249b0512e7e3c",
  measurementId: "G-52TT1X629K"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const db = getFirestore(app);
export { db };