<template>
  <form id='member-search' ref="search" role="form" method="GET" :action="actionUrl">
    <member-select-two
      v-model="myValue"
      :name="null"
      :placeholder="placeholder"
      :with-account="withAccount"
      :return-account-id="returnAccountId"
      :current-only="currentOnly"
      />
  </form>
</template>

<script>
 export default {
    props: {
      action: String,
      placeholder: String,
      // Search for only users with an account
      withAccount: Boolean,
      // Return Account ID instead of User ID
      returnAccountId: Boolean,
      // Search for only current members
      currentOnly: Boolean,
    },

    data() {
      return {
        myValue: '',
      }
    },

    computed: {
      actionUrl() {
        return this.action.replace("_ID_", this.myValue);
      },
    },

    watch: {
      actionUrl() {
        // use val to replace _ID_ in the action url and submit form
        // console.log(this.actionUrl);
        this.$nextTick(() => {
          this.$refs.search.submit();
        });
      },
    },
 }
</script>
