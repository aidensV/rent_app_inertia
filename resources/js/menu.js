import {
  mdiAccountCircle,
  mdiMonitor,
  mdiGithub,
  mdiAccountKey,
  mdiAccountEye,
  mdiAccountGroup,
  mdiPalette
} from '@mdi/js'

export default [
  {
    route: 'dashboard',
    icon: mdiMonitor,
    label: 'Dashboard'
  },
  {
    route: 'permission.index',
    icon: mdiAccountKey,
    label: 'Permissions'
  },
  {
    route: 'role.index',
    icon: mdiAccountEye,
    label: 'Roles'
  },
  {
    route: 'user.index',
    icon: mdiAccountGroup,
    label: 'Users'
  },
  {
    route: 'tool-manage.index',
    icon: mdiAccountGroup,
    label: 'Manajemen Alat'
  },
  {
    route: 'lab-manage.index',
    icon: mdiAccountGroup,
    label: 'Manajemen Lab'
  },
  {
    route: 'peminjaman.index',
    icon: mdiAccountGroup,
    label: 'Peminjaman Lab'
  },
  {
    route: 'peminjaman-alat.index',
    icon: mdiAccountGroup,
    label: 'Peminjaman Alat'
  },
  {
    route: 'form-clearance.index',
    icon: mdiAccountGroup,
    label: 'Pengajuan Form Clearence'
  },  
  {
    route: 'peminjaman.index',
    icon: mdiAccountGroup,
    label: 'Laporan Kerusakan'
  },  
  {
    route: 'peminjaman.index',
    icon: mdiAccountGroup,
    label: 'Panduan'
  },  
  {
    route: 'peminjaman.index',
    icon: mdiAccountGroup,
    label: 'Kontak'
  }, 
  {
    route: 'peminjaman.index',
    icon: mdiAccountGroup,
    label: 'Kritik & Saran'
  }, 

]
