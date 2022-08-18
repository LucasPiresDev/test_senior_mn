<template>
  <app-page-header :title="`Lista de ${this.title}`"></app-page-header>
  <data-tables
    :entity="this.entity"
    :allowDeleteMulti="false"
    :allowDisableMulti="false"
    :allowEnableMulti="false"
    :options="{
      ajax: {
        url: `api/${this.url}`,
      },
      columns: this.columns,
    }"
    :actions="{
      create: {
        allow: true,
        url: `${this.url}/create`,
      },
      show: {
        allow: false,
        url: '*',
        callback: onShow,
      },
      edit: {
        allow: true,
        url: `${this.url}/*/edit`,
      },
      delete: {
        allow: true,
        url: '*',
      },
    }"
    :filters="this.filters"
    :statusFilterIndex="this.indexstatusfilter"
  ></data-tables>
</template>

<script>
import PageHeader from "./PageHeaderComponent.vue";
import DataTables from "./DataTableComponent.vue";

export default {
  props: {
    title: String,
    columns: Array,
    url: String,
    entity: String,
    filters: { type: Array, default: [] },
    indexstatusfilter: { type: Number, default: -1 },
  },
  components: {
    "app-page-header": PageHeader,
    "data-tables": DataTables,
  },
};
</script>