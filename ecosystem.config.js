module.exports = {
  apps : [
    {
      name: 'mirror-dev',
      script: 'npm',
      args: 'run dev-start'
    },
    {
      name: 'mirror-demo',
      script: 'npm',
      args: 'run demo-start'
    }
  ]
};
