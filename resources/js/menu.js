import {
  mdiContacts,
  mdiMonitor,
  mdiFormSelect,
  mdiAccountKey,
  mdiAccountEye,
  mdiAccountGroup,
  mdiOfficeBuilding,
  mdiApplication,
  mdiNotebookEdit
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
    icon: mdiApplication,
    label: 'Manajemen Alat'
  },
  {
    route: 'lab-manage.index',
    icon: mdiOfficeBuilding,
    label: 'Manajemen Lab'
  },
  {
    route: 'peminjaman.index',
    icon: mdiOfficeBuilding,
    label: 'Peminjaman Lab'
  },
  {
    route: 'peminjaman-alat.index',
    icon: mdiApplication,
    label: 'Peminjaman Alat'
  },
  {
    route: 'form-clearance.index',
    icon: mdiFormSelect,
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
    route: 'kontak.index',
    icon: mdiContacts,
    label: 'Kontak'
  },
  {
    route: 'kritik.index',
    icon: mdiNotebookEdit,
    label: 'Kritik & Saran'
  }, 

]
