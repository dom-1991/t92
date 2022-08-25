export default ( context, inject ) => {
  const c = { // Constant

    // General
    FORMAT_DATE: 'YYYY-MM-DD',
    FORMAT_MONTH: 'YYYY-MM',
    FORMAT_DATETIME: 'YYYY-MM-DD HH:mm',

    // List status
    STATUS_NEW: 1,
    STATUS_AWAITING_APPROVAL: 2,
    STATUS_REJECTED: 3,
    STATUS_APPROVED: 4,

    // List sample
    SAMPLE_TYPE_A: 1,
    SAMPLE_TYPE_B: 2,

    // List Permissions
    // PERMISSION_PERMISSION: 'permission',
    PERMISSION_GROUP: 'group',
    PERMISSION_ROLE: 'role',
    PERMISSION_USER: 'user',
    PERMISSION_MASTER: 'master',

  }

  inject('c',{...c})  // $c = constant
}
