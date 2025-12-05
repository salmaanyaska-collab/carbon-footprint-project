const mongoose = require('mongoose');

// Define the schema for the user
const userSchema = new mongoose.Schema({
    username: {
        type: String,
        required: true
    },
    email: {
        type: String,
        required: true,
        unique: true
    },
    password: {
        type: String,
        required: true
    }
});

// Create a model based on the schema
const User = mongoose.model('User', userSchema);

module.exports = User;
