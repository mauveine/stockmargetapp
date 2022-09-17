const path = require('path');

module.exports = {
    // configuration options for how webpack resolves modules
    resolve: {
        alias: {
            // add as many aliases as you like!
            "@": path.resolve(__dirname, 'resources/js/')
        }
    }
}
