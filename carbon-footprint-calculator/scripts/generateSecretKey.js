// generateSecretKey.js

const crypto = require('crypto');

// Generate a 64-character random secret key (32 bytes)
const secretKey = crypto.randomBytes(32).toString('hex');

// Output the generated secret key to the console
console.log(secretKey);
