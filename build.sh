#!/bin/bash
# Build script for production deployment

echo "🚀 Building assets for production..."

# Install dependencies if needed
if [ ! -d "node_modules" ]; then
    echo "📦 Installing dependencies..."
    npm install
fi

# Build assets with Vite
echo "🔨 Building with Vite..."
npm run build

# Verify build output
if [ -f "public/build/manifest.json" ]; then
    echo "✅ Build completed successfully!"
    echo "📁 Build files:"
    ls -la public/build/assets/
else
    echo "❌ Build failed - manifest.json not found"
    exit 1
fi

echo "🎉 Production build ready!"
