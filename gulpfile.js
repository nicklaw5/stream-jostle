grunt.loadNpmTasks('grunt-electron-installer')

'create-windows-installer': {
  x64: {
    appDirectory: '/tmp/build/my-app-64',
    outputDirectory: '/tmp/build/installer64',
    authors: 'My App Inc.',
    exe: 'myapp.exe'
  },
  ia32: {
    appDirectory: '/tmp/build/my-app-32',
    outputDirectory: '/tmp/build/installer32',
    authors: 'My App Inc.',
    exe: 'myapp.exe'
  }
}