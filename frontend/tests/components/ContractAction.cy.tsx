import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import ContractAction from '../../src/components/ContractAction'


describe('ContractAction.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><ContractAction /></Provider>)
  })
})