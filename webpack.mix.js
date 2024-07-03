const mix = require('laravel-mix');

// Copy everything from the public folder to the public folder
// This is useful if you're not compiling assets but just want to ensure they're copied over
mix.copy('public', 'public');

// If you have SASS files that need compiling
if (fs.existsSync('./public/sass')) {
    mix.sass('public/sass/app.scss', 'public/css');
}
