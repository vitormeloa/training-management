module.exports = {
  devServer: {
    port: 8080,
    proxy: {
      '/api': {
        target: 'http://backend:80',
        changeOrigin: true,
        pathRewrite: { '^/api': '' },
      },
    },
  },
};
